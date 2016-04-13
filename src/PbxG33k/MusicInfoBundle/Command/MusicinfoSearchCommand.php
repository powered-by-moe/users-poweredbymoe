<?php

namespace PbxG33k\MusicInfoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MusicinfoSearchCommand extends ContainerAwareCommand
{
    protected $musicInfoService;
    
    protected function configure()
    {
        $this
            ->setName('musicinfo:search')
            ->setDescription('...')
//            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->musicInfoService = $this->getContainer()->get('pbxg33k.musicinfo');

//        $this->musicInfoService->artist()->getByName('meh');

//        $this->musicInfoService->getPreferredService();
        
        dump($this->musicInfoService->getPreferredService()->artist()->getByName("Hardwell"));
        $output->writeln('Command result.');
    }

}
