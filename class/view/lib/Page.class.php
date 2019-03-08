<?php
class Page
{
    protected $doc;
    public function showDoc()
    {
        echo $this->doc;
    }
    
    public function initHTML($titre, $css)
    {
        $retStr = "<!DOCTYPE html>\n";
        $retStr .= "<html lang='fr'>\n";
        $retStr .= "<head>\n";
        $retStr .= "<title>".$titre."</title>\n";
        if (!empty($css)) {
            $retStr .= '<link rel="stylesheet" type="text/css" href="' . $css .'">';
        }
        $retStr .= "</head>\n";
        $retStr .= "<body>\n";
        return $retStr;
    }

    public function beginForm($method, $action, $name)
    {
        return "<form method='" . $method . "' action='" . $action . "' name='" . $name . "' >\n";
    }

    public function insertInput($type, $name, $humantext)
    {
        $retStr = "<p><label for='" . $name . "'>" . $humantext . "</label><br/>";
        return $retStr . "<input name='" . $name . "' type='" . $type . "' value='' /> </p>";
    }

    public function insertInputWithValue($type, $name, $humantext, $value)
    {
        return "<p><input name='" . $name . "' type='" . $type . "' value='" . $value . "' /> </p>";
    }



    public function insertHidden($name, $value)
    {
        return "<input type='hidden' name='" . $name . "' value='" . $value . "' ></input>";
    }

    public function createLink($href, $text)
    {
        return '<a href="' . $href . '">' . $text . '</a>';
    }

    public function beginBal($bal)
    {
        return "<" . $bal . ">";
    }

    public function endBal($bal)
    {
        return "</" . $bal . ">";
    }

    public function br()
    {
        return "<br/>\n";
    }

    public function beginEndBal($bal, $content)
    {
        $retStr = Page::beginBal($bal);
        $retStr .= $content;
        $retStr .= Page::endBal($bal);
        return $retStr . "\n";
    }
}
