<?php

namespace Weiaibaicai\Ueditor\Form;

use Dcat\Admin\Admin;
use Dcat\Admin\Form\Field;
use Illuminate\Support\Str;

/**
 * 百度在线编辑器
 *
 * User: jqh
 * Date: 18-12-19
 * Time: 下午4:42
 */
class UEditor extends Field
{

    protected $options = [
        // 编辑器默认高度
        'initialFrameHeight' => 400,
        'maximumWords'       => 100000,
        'serverUrl'          => '',
    ];

//    protected $view = 'ueditor::ueditor';
//
    protected $view = 'weiaibaicai.ueditor::ueditor';


    /**
     * @var string
     */
    protected $disk;

    /**
     * 设置编辑器高度
     *
     * @param int $height
     *
     * @return $this
     */
    public function height(int $height)
    {
        $this->options['initialFrameHeight'] = $height;

        return $this;
    }

    /**
     * 设置上传接口
     *
     * @param string $url
     *
     * @return $this
     */
    public function server(string $url)
    {
        $this->options['serverUrl'] = url()->isValidUrl($url) ? $url : admin_base_path($url);

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function disk()
    {
        $disk = config('ueditor.disk');
        if (empty($disk)) {
            $disk = config('admin.upload.disk');
        }

        $this->disk = $disk;

        return $this;
    }

    /**
     * @return string
     */
    protected function formatOptions()
    {
        if (empty($this->options['serverUrl'])) {
            $this->server('/ueditor/serve');
        }

        return json_encode($this->options);
    }

    /**
     * 初始化js
     */
    protected function setupScript()
    {
        $this->attribute('id', $id = $this->generateId());
        $this->addVariables(['id' => $id]);
        $opts = $this->formatOptions();

        $this->script = <<<JS
(function () {
    var vla = $('#{$id}-vla').val();
    var ue = UE.getEditor('{$id}', {$opts});
    ue.ready(function() {
        ue.setContent(vla);
        ue.execCommand('serverparam', '_token', Dcat.token);
        ue.execCommand('serverparam', 'disk', '{$this->disk}');
    });
})();
JS;

    }

    protected function generateId()
    {
        return 'ueditor-' . Str::random(8);
    }

    /**
     * Get the view variables of this field.
     *
     * @return array
     */
    public function variables()
    {
        return array_merge(parent::variables(), [
            'homeUrl' => admin_asset('@extension/weiaibaicai/ueditor') . '/',
        ]);
    }

    /**
     * @return string
     */
    public function render()
    {
        Admin::requireAssets('@weiaibaicai.ueditor');

        $this->disk();

        $this->setupScript();

        return parent::render();
    }
}
