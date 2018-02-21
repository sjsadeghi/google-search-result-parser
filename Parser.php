<?php
require('simple_html_dom.php');
class Parser{
    private $titles=[];
    private $links=[];
    private $res=[];
    private $page=0; // max of pages
    private $q="";
    public function __construct($q,$page=50){
      $this->page=$page;
      $this->q=url_encode($q);
    }
    public function parse(){
      $i=0;
      while($i<=$this->page){
        $url="https://www.google.com/search?q={$this->q}";
        $html = file_get_html($url);
        foreach($html->find('h3.r') as $element)
          array_push($this->titles, $element->plaintext);

        foreach($html->find('h3.r a') as $element)
          array_push($this->links, $element->href);

        for($i=0;$i<count($this->titles);$i++)
        {
            $this->res[$i]['title']=$this->titles[$i];
            $this->res[$i]['link']=$this->links[$i];
        }
        $i+=10;
      }
      return $this->res;
    }
}
?>
