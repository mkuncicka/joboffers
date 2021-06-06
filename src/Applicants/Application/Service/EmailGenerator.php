<?php


namespace App\Applicants\Application\Service;


class EmailGenerator implements GeneratorInterface
{
    PRIVATE CONST CHAR_NUMBER = 20;
    PRIVATE CONST PREFIX_LENGTH = 5;
    public function generate()
    {
        $numeric =  '0123456789';
        $alphabetic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $extras = '.-_';
        $all = $numeric . $alphabetic . $extras;
        $newEmail = '';
        $newprefix = '';
        for($i = 0; $i < self::CHAR_NUMBER; $i++) {
            $newEmail .= $all[rand(0, strlen($all)-1)];

        }
        for($i = 0; $i < self::PREFIX_LENGTH; $i++) {
            $newprefix .= $all[rand(0, strlen($all)-1)];
        }
        return $newEmail . '@' . $newprefix . $this->getRandomSuffix();
    }

    private function getRandomSuffix()
    {
        $suffixes = [
            '.com',
            '.pl',
            '.io',
            '.org',
            '.co',
        ];

        return $suffixes[rand(0, count($suffixes)-1)];

    }
}