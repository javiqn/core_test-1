<?php

declare(strict_types=1);

use Tests\TestCase;

class SkeletonTest extends TestCase
{
    public function test_success(): void
    {
        $test = "e";

        $this->assertEquals(expected: "e", actual: $test);
    }
}
