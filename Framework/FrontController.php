<?php
namespace Framework;

class FrontController extends Base
{
    function handleRequest()
    {
        $cmd = (new CommandResolver())->getCommand();
        /** @var Controller $cmd */
        $cmd->execute();
    }
}