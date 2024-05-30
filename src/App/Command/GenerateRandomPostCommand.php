<?php

namespace App\Command;

use Domain\Post\PostManager;
use joshtronic\LoremIpsum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateRandomPostCommand extends Command
{
    protected static $defaultName = 'app:generate-random-post';
    protected static $defaultDescription = 'Run app:generate-random-post';

    private LoremIpsum $loremIpsum;

    private PostManager $postManager;

    public function __construct(LoremIpsum $loremIpsum, PostManager $postManager, string $name = null)
    {
        parent::__construct($name);
        $this->loremIpsum = $loremIpsum;
        $this->postManager = $postManager;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $title = $this->loremIpsum->words(mt_rand(4, 6));
        $content = $this->loremIpsum->paragraphs(2);

        $this->postManager->addPost($title, $content);

        $output->writeln('A random post has been generated.');

        return Command::SUCCESS;
    }
}
