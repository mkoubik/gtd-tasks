<?php

namespace NetteCli;

interface CommandSet
{
	public function addCommands(\Symfony\Component\Console\Application $cli);
}
