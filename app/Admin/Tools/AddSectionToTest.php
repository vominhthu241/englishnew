<?php

namespace App\Admin\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class AddSectionToTest extends BatchAction
{
    protected $action;

    public function __construct($action = 1)
    {
        $this->action = $action;
    }

    public function script()
    {
        return <<<EOT
        $('{$this->getElementClass() }').on('click', function() {
            var url = window.location.href;
            var splitString = url.split('test/')[1];
            var param = splitString.split('/')[0];

            alert(selectedRows());
            alert('param is: ' + param);
            $.ajax({
                method: 'post',
                url: 'http://127.0.0.1:8000/admin/test/addSections',
                data: {
                    _token:'{$this->getToken()}',
                    test_id: param,
                    section_id: selectedRows()
                },
                success: function () {
                    alert('success');
                },
                fail: function(data) {
                    console.log(data);
                    console.log({$this->getToken()});
                }
            });
        });
EOT;
    }
}