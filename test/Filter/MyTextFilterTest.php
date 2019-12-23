<?php

namespace Aiur18\Filter;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 */
class MyTextFilterTest extends TestCase
{

    /**
     * Testing the parce
     *
     */
    public function testValueParse()
    {
        $test = new MyTextFilter();
        $text = "[b]Bold text[/b] http://www.google.com";
        $filter = ["bbcode", "link"];

        $res = $test->parse($text, $filter);
        $exp = "<strong>Bold text</strong> <a href=\'http://www.google.com\'>http://www.google.com</a>";
        $this->assertEquals($exp, $res);
    }



    /**
     * Testing the method bbcode
     *
     */
    public function testValuebbcode()
    {
        $test = new MyTextFilter();
        $text = "[b]Bold text[/b]";

        $res = $test->bbcode2html($text);
        $exp = "<strong>Bold text</strong>";
        $this->assertEquals($exp, $res);
    }

    /**
     * Testing Makeclickable mathod
     *
     */
    public function testValueClickable()
    {
        $test = new MyTextFilter();
        $text = "http://www.google.com";

        $res = $test->makeClickable($text);
        $exp = "<a href=\'http://www.google.com\'>http://www.google.com</a>";
        $this->assertEquals($exp, $res);
    }

    /**
     * Testing the method markdown
     *
     */
    public function testValueMarkdown()
    {
        $test = new MyTextFilter();
        $text = "### Header level 3";

        $res = $test->markdown($text);
        $exp = "<h3>Header level 3</h3>\n";
        $this->assertEquals($exp, $res);
    }
}
