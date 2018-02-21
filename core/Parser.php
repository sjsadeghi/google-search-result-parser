<?php
require('simple_html_dom.php');

/**
 * Class Parser
 */
class Parser
{
    private $titles = [];
    private $links = [];
    private $res = [];
    private $op = array('page' => 0, 'q' => '');

    public function __construct($text, $page_count = 50)
    {
        $this->op['q'] = urlencode($text);
        $this->op['page'] = $page_count;
    }

    /**
     * parse google search result
     * @return array
     */
    public function parse()
    {
        $i = 0;
        while ($i <= $this->op['page']) {
            $url = "https://www.google.com/search?q={$this->op['q']}";
            $html = file_get_html($url);
            foreach ($html->find('h3.r') as $element)
                array_push($this->titles, $element->plaintext);

            foreach ($html->find('h3.r a') as $element)
                array_push($this->links, $element->href);

            for ($i = 0; $i < count($this->titles); $i++) {
                $this->res[$i]['title'] = $this->titles[$i];
                $this->res[$i]['link'] = $this->links[$i];
            }
            $i += 10;
        }
        return $this->res;
    }
}

?>
