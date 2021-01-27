<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'O :attribute deve ser aceito.',
    'active_url'           => 'O :attribute não é uma URL válida',
    'after'                => 'O :attribute deve ser uma data depois :date.',
    'after_or_equal'       => 'O :attribute deve ser uma data depois ou iqual a :date.',
    'alpha'                => 'O :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O :attribute só pode conter letras, números e traços.',
    'alpha_num'            => 'O :attribute só pode conter letras e números.',
    'array'                => 'O :attribute deve ser uma matriz (array).',
    'before'               => 'O :attribute deve ser uma data antes :date.',
    'before_or_equal'      => 'O :attribute deve ser uma data antes ou iqual a :date.',
    'between'              => [
        'numeric' => 'O :attribute deve estar entre :min e :max.',
        'file'    => 'O :attribute deve estar entre :min e :max KB.',
        'string'  => 'O :attribute deve estar entre :min e :max caracteres.',
        'array'   => 'O :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'O :attribute confirmação não corresponde.',
    'date'                 => 'O :attribute não é uma data válida.',
    'date_format'          => 'O :attribute não corresponte a forma :format.',
    'different'            => 'O :attribute e :other devem ser diferentes.',
    'digits'               => 'O :attribute deve ser :digits digitos.',
    'digits_between'       => 'O :attribute deve estar entre :min e :max digitos.',
    'dimensions'           => 'O :attribute tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo :attribute tem valores duplicado.',
    'email'                => 'O :attribute deve ser um email válida.',
    'exists'               => 'O :attribute selecionado é inválido',
    'file'                 => 'O :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute ter um valor.',
    'image'                => 'O :attribute deve ser uma imagem.',
    'in'                   => 'O :attribute selecionado é invalid.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O :attribute deve ser um inteiro.',
    'ip'                   => 'O :attribute deve ser um endereço de IP válido.',
    'ipv4'                 => 'O :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O :attribute deve ser JSON (em string) válido.',
    'max'                  => [
        'numeric' => 'O :attribute não pode ser maior que :max.',
        'file'    => 'O :attribute não pode ser maior que :max KB.',
        'string'  => 'O :attribute não pode ser maior que :max caracteres.',
        'array'   => 'O :attribute não pode ter mais de :max itens.',
    ],
    'mimes'                => 'O :attribute deve ser um arquivo de type: :values.',
    'mimetypes'            => 'O :attribute deve ser um arquivo de type: :values.',
    'min'                  => [
        'numeric' => 'O :attribute deve ser pelo menos :min.',
        'file'    => 'O :attribute deve ser pelo menos :min KB.',
        'string'  => 'O :attribute deve ser pelo menos :min caracteres.',
        'array'   => 'O :attribute deve ter pelo menos :min itens.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => 'O :attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório, a menos que :other esteja em :values.',
    'required_with'        => 'O campo :attribute é necessário quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é necessário quando :values está presente.',
    'required_without'     => 'O campo :attribute é necessário quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é necessário quando nenhum :values está presente.',
    'same'                 => 'O :attribute e :other devem corresponder.',
    'size'                 => [
        'numeric' => 'O :attribute deve ter :size.',
        'file'    => 'O :attribute deve ter :size KB.',
        'string'  => 'O :attribute deve ter :size caracteres.',
        'array'   => 'O :attribute deve conter :size itens.',
    ],
    'string'               => 'O :attribute deve ser uma cadeia de caracteres (string).',
    'timezone'             => 'O :attribute deve ser uma zona válida.',
    'unique'               => 'O :attribute já existe',
    'uploaded'             => 'O campo :attribute para upload.',
    'url'                  => 'O formato do :attribute é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
