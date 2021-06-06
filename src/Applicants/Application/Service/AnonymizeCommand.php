<?php


namespace App\Applicants\Application\Service;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnonymizeCommand extends Command
{
    protected static $defaultName = 'app:anonymize';
    /**
     * @var AnonymizerInterface
     */
    private $anonymizer;

    public function __construct(string $name = null, AnonymizerInterface $anonymizer)
    {
        parent::__construct($name);
        $this->anonymizer = $anonymizer;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $result = $this->anonymizer->anonymize();
        } catch(\Exception $e) {
            return Command::FAILURE;
        }

        return $result ? Command::SUCCESS : Command::FAILURE;
    }
}