<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;
use Auth;
class Nilaiskor extends AbstractAction
{
    public function getTitle()
    {
        return 'Nilaiskor';
    }

    public function getIcon()
    {
        return 'voyager-documentation';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-dark pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('admin/nilaiskor',$this->data->id);
    }
    public function shouldActionDisplayOnDataType()
    {
    return $this->dataType->slug == 'tb-tryout';
    }

}
