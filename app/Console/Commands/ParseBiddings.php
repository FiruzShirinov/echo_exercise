<?php

namespace App\Console\Commands;

use DOMXPath;
use DOMDocument;
use Carbon\Carbon;
use App\Models\Bidding;
use Illuminate\Console\Command;

class ParseBiddings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bidding:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse biddings from predefined exchange trading floors';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('max_execution_time', '600');
        ini_set('memory_limit', '256M');

        $cols = [
            'number',
            'organizer',
            'debtor',
            'subject',
            'status',
            'started_at'
        ];

        $exchangeUrl = 'https://etp.kartoteka.ru/index.html';
        $lastPage = $this->getLastPageNumber($exchangeUrl);

        libxml_use_internal_errors(true);
        $dom = new DOMDocument;

        $tableData = [];
        for ($i=1; $i < $lastPage; $i++) {
            $dom->loadHtmlFile("$exchangeUrl?page=$i");
            $xpath = new DOMXPath($dom);

            $rows = $xpath->query('//table[@class="data"]/tr');

            foreach ($rows as $row) {
                $cells = $xpath->query('td[@colspan="1"]', $row);
                $cellData = [];
                $colIndex = 0;
                if ($cells->length > 0) {
                    foreach ($cells as $cell) {
                        $subCells = $xpath->query('div', $cell);
                        if ($subCells->length > 0) {
                            foreach ($subCells as $subCell) {
                                $cellData[$cols[$colIndex]] = trim($subCell->nodeValue);
                                $colIndex++;
                            }
                            $colIndex--;
                        } else {
                            $cellData[$cols[$colIndex]] = trim($cell->nodeValue);
                        }
                        $colIndex++;
                    }
                    $tableData[] = $cellData;
                }
            }
        }
        $this->refreshData($tableData);
    }

    private function getLastPageNumber(string $exchangeUrl)
    {
        libxml_use_internal_errors(true);
        $dom = new DomDocument;
        $dom->loadHtmlFile($exchangeUrl);
        $xpath = new DomXPath($dom);

        $rows = $xpath->query('//table[@class="data"]/tr');

        foreach ($rows as $htmlPage) {
            $htmlPages = $xpath->query('td[@colspan="5"]', $htmlPage);
            if ($htmlPages->length > 0) {
                foreach ($htmlPages as $pages) {
                    $pages = $xpath->query('a', $pages);
                    $lastPage = $pages->item($pages->length-1)->nodeValue;
                }
            }
        }

        return $lastPage;
    }

    private function refreshData(array $biddings)
    {
        if (!empty($biddings)) {
            $bar = $this->output->createProgressBar(count($biddings));
            $bar->start();

            foreach ($biddings as $bidding) {
                Bidding::updateOrCreate(
                    [
                        'number' => $bidding['number'],
                        'status' => $bidding['status'],
                    ],
                    [
                        'organizer' => $bidding['organizer'],
                        'debtor' => $bidding['debtor'],
                        'subject' => $bidding['subject'],
                        'started_at' => Carbon::parse($bidding['started_at'])->format('Y-m-d H:i:s'),
                    ]
                );
                $bar->advance();
            }
            $bar->finish();
        }
    }
}
