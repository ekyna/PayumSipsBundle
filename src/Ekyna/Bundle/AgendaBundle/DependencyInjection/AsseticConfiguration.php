<?php

namespace Ekyna\Bundle\AgendaBundle\DependencyInjection;

/**
 * Class AsseticConfiguration
 * @package Ekyna\Bundle\AgendaBundle\DependencyInjection
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class AsseticConfiguration
{
    /**
     * Builds the assetic configuration.
     *
     * @param array $config
     * @return array
     */
    public function build(array $config)
    {
        $output = array();

        // Fix path in output dir
        if ('/' !== substr($config['output_dir'], -1) && strlen($config['output_dir']) > 0) {
            $config['output_dir'] .= '/';
        }

        $output['fullCalendar_css'] = $this->buildFullCalendarJs($config);

        return $output;
    }

    /**
     * @param array $config
     * @return array
     */
    protected function buildFullCalendarJs(array $config)
    {
        $inputs = array(
            '@EkynaAgendaBundle/Resources/asset/js/fullcalendar.js',
            '@EkynaAgendaBundle/Resources/asset/js/lang-all.js',
        );

        return array(
            'inputs'  => $inputs,
            'filters' => array('yui_js'),
            'output'  => $config['output_dir'].'js/fullcalendar.js',
            'debug'   => false,
        );
    }
}
