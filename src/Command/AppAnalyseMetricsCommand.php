<?php declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Psr\Log\LoggerInterface;
use App\DataLayer\DataParser;
use App\Controller\StatisticsController;

/**
 * Class AppAnalyseMetricsCommand
 *
 * @package App\Command
 */
class AppAnalyseMetricsCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:analyse-metrics';

    /** @var \App\Controller\StatisticsController  */
    private $statistics;
    /** @var \App\DataLayer\DataParser  */
    private $dataParser;
    /** @var \Psr\Log\LoggerInterface  */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->dataParser = new DataParser();
        $this->statistics = new StatisticsController($logger);
        parent::__construct();
    }

    /**
     * Configure the command.
     */
    protected function configure(): void
    {
        $this->setDescription('Analyses the metrics to generate a report.');
        $this->addOption('input', null, InputOption::VALUE_REQUIRED, 'The location of the test input');
    }

    /**
     * Detect slow-downs in the data and output them to stdout.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        print_r($input->getOption('input'));

        $io = new SymfonyStyle($input, $output);
        $data = $this->dataParser->json2array($input->getOption('input'));
        $output = $this->statistics->analyzer($data);
        $io->success($output);
    }
}
