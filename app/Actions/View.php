<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;
use Auth;
class View extends AbstractAction
{
    public function getTitle()
    {
        return 'View';
    }

    public function getIcon()
    {
        return 'voyager-eye';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('admin/view',$this->data->id);
    }
    public function shouldActionDisplayOnDataType()
    {
    return $this->dataType->slug == 'tb-tryout';
    }

}
