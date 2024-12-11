<?php
/** User: Aviet Lobo ...*/

namespace app\core\form;

use app\core\Model;

/**
 * Class Field
 *
 * @author Aviet Lobo <avietlobo@gmail.com>
 * @package app\core\form
 */

class Field
{


    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_DROPDOWN = 'dropdown'; // Add dropdown type

    public string $type;
public Model $model;
public string $attribute;
    public array $options = []; // Store options for dropdown fields

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function dropdownField(array $options): self
    {
        $this->type = self::TYPE_DROPDOWN;
        $this->options = $options;
        return $this;
    }

    public function __toString()
    {
        if ($this->type === self::TYPE_DROPDOWN) {
            return sprintf('
                <div class="form-group mb-3">
                    <label class="label">%s</label>
                    <select name="%s" class="form-control%s">
                        %s
                    </select>
                    <div class="invalid-feedback">
                        %s
                    </div>
                </div>',
                $this->model->labels()[$this->attribute] ?? $this->attribute,
                $this->attribute,
                $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                $this->renderOptions(),
                $this->model->getFirstError($this->attribute)
            );
        }

        return sprintf('
 <div class="form-group mb-3">
    <label class="label">%s</label>
    <input type="%s" name="%s" value = "%s" class="form-control%s" >
    <div class = "invalid-feedback">
    %s
</div>
  </div>',
            $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute  )
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    protected function renderOptions(): string
    {
        $optionsHtml = '';
        foreach ($this->options as $value => $label) {
            $selected = $this->model->{$this->attribute} === $value ? 'selected' : '';
            $optionsHtml .= sprintf('<option value="%s" %s>%s</option>', $value, $selected, $label);
        }
        return $optionsHtml;
    }


}