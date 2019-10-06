<?php

namespace Tests\Browser\Pages\CmsApplications;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class CmsApplicationsPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/cms-applications';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  \Laravel\Dusk\Browser $browser
     * @return void
     * @throws \Facebook\WebDriver\Exception\TimeOutException
     */
    public function assert(Browser $browser)
    {
        $browser->waitForLocation($this->url())->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
