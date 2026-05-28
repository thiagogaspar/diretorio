<?php

namespace App\Purify\Definitions;

use HTMLPurifier_HTMLDefinition;
use Stevebauman\Purify\Definitions\Definition;
use Stevebauman\Purify\Definitions\Html5Definition;

class AppDefinition implements Definition
{
    public static function apply(HTMLPurifier_HTMLDefinition $definition): void
    {
        Html5Definition::apply($definition);

        $definition->addElement('div', 'Block', 'Flow', 'Common', ['style' => 'Text']);
        $definition->addElement('iframe', 'Block', 'Flow', 'Common', [
            'src' => 'URI',
            'width' => 'Length',
            'height' => 'Length',
            'title' => 'Text',
            'allowfullscreen' => 'Bool',
            'allow' => 'Text',
            'loading' => 'Enum#auto,lazy,eager',
            'referrerpolicy' => 'Text',
            'style' => 'Text',
            'frameborder' => 'Text',
        ]);
    }
}
