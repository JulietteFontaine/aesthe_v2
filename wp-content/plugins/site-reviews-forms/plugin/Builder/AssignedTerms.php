<?php

namespace GeminiLabs\SiteReviews\Addon\Forms\Builder;

use GeminiLabs\SiteReviews\Addon\Forms\Application;
use GeminiLabs\SiteReviews\Helpers\Arr;
use GeminiLabs\SiteReviews\Helpers\Cast;
use GeminiLabs\SiteReviews\Modules\Html\Fields\Field;

class AssignedTerms extends Field
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return Cast::toBool($this->args()->hidden)
            ? $this->buildHidden()
            : $this->buildSelect();
    }

    /**
     * @return string|void
     */
    protected function buildHidden()
    {
        return $this->builder->input([
            'name' => $this->args()->name,
            'type' => 'hidden',
            'value' => implode(',', Arr::consolidate($this->args()->terms)),
        ]);
    }

    /**
     * @return string|void
     */
    protected function buildSelect()
    {
        $options = glsr()->filterBool('builder/enable/optgroup', false)
            ? $this->termGroups()
            : $this->terms();
        $field = $this->args()->merge([
            'class' => 'glsr-select',
            'options' => $options,
        ]);
        return $this->builder->select($field->toArray());
    }

    /**
     * @param string $fields
     * @return array
     */
    protected function terms($fields = 'id=>name')
    {
        $args = glsr(Application::class)->filterArray('builder/assigned_terms/args', [
            'count' => false,
            'fields' => $fields,
            'hide_empty' => false,
            'include' => Arr::consolidate($this->builder->args->terms),
            'taxonomy' => glsr()->taxonomy,
        ], $this->args());
        return get_terms($args);
    }

    /**
     * @return array
     */
    protected function termGroups()
    {
        $options = [];
        $terms = $this->terms('all');
        foreach ($terms as $term) {
            if ($term->parent) {
                continue;
            }
            $children = array_filter($terms, function ($child) use ($term) {
                return $term->term_id === $child->parent;
            });
            if (empty($children)) {
                $options[$term->term_id] = $term->name;
                continue;
            }
            $options[$term->name] = [];
            foreach ($children as $child) {
                $options[$term->name][$child->term_id] = $child->name;
            }
        }
        return $options;
    }
}
