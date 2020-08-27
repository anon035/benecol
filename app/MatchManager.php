<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class MatchManager
{
    const ALL = 1;
    const UPCOMING = 2;
    const PAST = 3;

    public function __construct()
    {
        require_once app_path() . '/Functions/simple_html_dom.php';
    }

    public function getMatches($html, $categoryName = '')
    {
        $matches = [];
        $matchTable = $html->findFirst('body > div.clearfix');
        if (!$matchTable) {
            return $matches;
        }
        $lines = $matchTable->find('div.match div.clearfix');

        foreach ($lines as $line) {
            $match = [];
            $homeTeamHtml = $line->findFirst('div.l');
            $awayTeamHtml = $line->findFirst('div.r');
            $matchInfoHtml = $line->findFirst('div.c');

            $match['homeTeam']['name'] = $homeTeamHtml->findFirst('div.teamname')->innertext();
            $match['homeTeam']['logo'] = $homeTeamHtml->findFirst('div.teamlogo img')->src;

            $match['awayTeam']['name'] = $awayTeamHtml->findFirst('div.teamname-r')->innertext();
            $match['awayTeam']['logo'] = $awayTeamHtml->findFirst('div.teamlogo-r img')->src;

            $match['date'] = $matchInfoHtml->findFirst('span.scoredate')->innertext();
            $match['name'] = $categoryName;
            $score = $matchInfoHtml->find('span.score');
            $match['homeTeam']['score'] = $score[0]->innertext();
            $match['awayTeam']['score'] = $score[1]->innertext();

            if (strpos($match['homeTeam']['name'], 'BENECOL') !== false) {
                $match['homeTeam']['name'] = '<strong>' . $match['homeTeam']['name'] . '</strong>';
            }
            if (strpos($match['awayTeam']['name'], 'BENECOL') !== false) {
                $match['awayTeam']['name'] = '<strong>' . $match['awayTeam']['name'] . '</strong>';
            }

            $matches[] = $match;
        }
        return $matches;
    }

    public function getPoints($html)
    {
        $points = [];
        $lines = $html->find('table.full tbody tr');

        foreach ($lines as $line) {
            $club = [];
            $values = $line->find('td');
            $i = 0;
            foreach ($values as $value) {
                if ($i == 2) {
                    $teamName = $value->innertext();
                    if (strpos($teamName, 'BENECOL') !== false) {
                        $teamName = '<strong>' . $teamName . '</strong>';
                    }
                    $club[1] .= ' ' . $teamName;
                } else {
                    $club[$i] = $value->innertext();
                }
                $i++;
            }
            $points[] = $club;
        }

        return $points;
    }

    /**
     * Returns previous or future matches
     */
    public function getAllMatches($mode = self::ALL, $count = null, $sort = 'asc')
    {
        $matches = [];

        foreach (Category::all() as $category) {
            if (preg_match('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $category->futbalnet_path)) {
                $matches = array_merge($matches, $this->getMatches(file_get_html($category->futbalnet_path), $category->name));
            }
        }
        if ($mode == self::UPCOMING) {
            $matches = array_filter($matches, function ($match) {
                return strtotime($match['date']) > time();
            });
        } else if ($mode == self::PAST) {
            $matches = array_filter($matches, function ($match) {
                return strtotime($match['date']) < time();
            });
        }
        if ($sort == 'asc') {
            uasort($matches, function ($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });
        } else {
            uasort($matches, function ($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });
        }

        if ($count) {
            return array_slice($matches, 0, $count);
        }

        return $matches;
    }
}
