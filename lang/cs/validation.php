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

    'accepted' => ':attribute musí být přijato.',
    'accepted_if' => ':attribute musí být přijato když :other je :value.',
    'active_url' => ':attribute musí být validní URL.',
    'after' => ':attribute musí být později než :date.',
    'after_or_equal' => ':attribute musí být později nebo stejný datum jako :date.',
    'alpha' => ':attribute musí obsahovat pouze písmena.',
    'alpha_dash' => ':attribute musí obsahovat pouze písměna, číslice, podtržítka a pomlčky',
    'alpha_num' => ':attribute musí obsahovat pouze písmena a číslice.',
    'array' => ':attribute musí být pole.',
    'before' => ':attribute musí být před :date.',
    'before_or_equal' => ':attribute musí být před nebo den jako :date.',
    'between' => [
        'array' => ':attribute musí mít mezi :min a :max položkami.',
        'file' => ':attribute musí být mezi :min a :max kilobajtami.',
        'numeric' => ':attribute musí být mezi :min a :max.',
        'string' => ':attribute musí být mezi :min a :max znaky.',
    ],
    'boolean' => ':attribute musí mít hodnotu Pravda nebo Nepravda.',
    'confirmed' => ':attribute potvrzení nesouhlasí.',
    'current_password' => 'Špatné heslo.',
    'date' => ':attribute musí být validní datum.',
    'date_equals' => ':attribute musí se rovnat datumu :date.',
    'date_format' => ':attribute neodpovídá formátu :format.',
    'declined' => ':attribute musí být odmíntuto.',
    'declined_if' => ':attribute musí být nadefinováno když :other má hodnotu :value.',
    'different' => ':attribute a :other se musí lišit.',
    'digits' => ':attribute musí mít :digits číslic.',
    'digits_between' => ':attribute musí být mezi :min a :max čislic.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => ':attribute má duplicitní hodnotu.',
    'doesnt_end_with' => ':attribute nesmí končit na nasledujicí: :values.',
    'doesnt_start_with' => ':attribute nesmí začínat na nasledujicí: :values.',
    'email' => ':attribute musí být validní email.',
    'ends_with' => ':attribute musí končit na: :values.',
    'enum' => 'Vybraná hodnota :attribute je neplatná.',
    'exists' => 'Vybraná hodnota :attribute je neplatná.',
    'file' => ':attribute musí být soubor.',
    'filled' => ':attribute pole nesmí být prázdné.',
    'gt' => [
        'array' => ':attribute musi mít více než :value položek.',
        'file' => ':attribute musí být větší než :value kilobajtů.',
        'numeric' => ':attribute musí být větší než :value.',
        'string' => ':attribute musí mít více než :value znaků.',
    ],
    'gte' => [
        'array' => ':attribute musí mít :value položek nebo více.',
        'file' => ':attribute musí mít stejne nebo více :value kilobajtů.',
        'numeric' => ':attribute musí být větší nebo stejně jak :value.',
        'string' => ':attribute musí mít stejně nebo více znaků než :value.',
    ],
    'image' => ':attribute musí být obrázek.',
    'in' => 'Vybraná hodnota :attribute je neplatná.',
    'in_array' => ':attribute pole neexistuje v hodnotách :other.',
    'integer' => ':attribute musí být celé číslo.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'array' => ':attribute musí mít méně než :value položek.',
        'file' => ':attribute musí být méně než :value kilobajtů.',
        'numeric' => ':attribute musí být méně než :value.',
        'string' => ':attribute musí mít méně než :value znaků.',
    ],
    'lte' => [
        'array' => ':attribute musí mít méně nebo stejně než :value položek.',
        'file' => ':attribute musí mít méně nebo stejně než :value kilobajtů.',
        'numeric' => ':attribute musí být stejně nebo méně než :value.',
        'string' => ':attribute musí mít stejně nebo méně než :value znaků.',
    ],
    'mac_address' => ':attribute musí být validní MAC adresa.',
    'max' => [
        'array' => ':attribute nesmí mít víc jak :max položek.',
        'file' => ':attribute nesmí být větší než :max kilobajtů.',
        'numeric' => ':attribute nesmí být větší než :max.',
        'string' => ':attribute nesmí mít víc jak :max znaků.',
    ],
    'max_digits' => ':attribute nesmí mít víc jak :max čísel.',
    'mimes' => ':attribute musí být souborového typu: :values.',
    'mimetypes' => ':attribute musí být typu: :values.',
    'min' => [
        'array' => ':attribute musí mít minimálně :min položek.',
        'file' => ':attribute musí mít minimálně :min kilobajtů.',
        'numeric' => ':attribute musí být minimálně :min.',
        'string' => ':attribute musí být minimálně :min znaků.',
    ],
    'min_digits' => ':attribute musí mít minimálně :min čísel.',
    'multiple_of' => ':attribute must be a multiple of :value.',
    'not_in' => 'Vybraná hodnota :attribute není validní.',
    'not_regex' => ':attribute formát není validní.',
    'numeric' => ':attribute musí být numerické.',
    'password' => [
        'letters' => ':attribute musí obsahovat alespoň jedno písmeno.',
        'mixed' => ':attribute musí obsahovat alespoň jedno malé a jedno velké písmeno.',
        'numbers' => ':attribute musí obsahovat alespoň jedno číslo.',
        'symbols' => ':attribute musí obsahovat alespoň jeden znak.',
        'uncompromised' => ':attribute bylo vyzrazeno. Doporučuje změnit jiné :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => ':attribute pole je povinné.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => ':attribute pole je povinné, jestliže :other má hodnotu :values.',
    'required_with' => ':attribute pole je povinné když :values je přítomné.',
    'required_with_all' => ':attribute pole je povinné když :values je přítomné.',
    'required_without' => ':attribute pole je povinné kdyý :values není vyplněné.',
    'required_without_all' => ':attribute pole je povinné, pokud hodnoty :values nejsou přítomny.',
    'same' => ':attribute a :other se musí shodovat.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => ':attribute musí začít s následujicím: :values.',
    'string' => ':attribute musí být řetězec.',
    'timezone' => ':attribute musí být spárvná časová zóna.',
    'unique' => ':attribute již existuje.',
    'uploaded' => ':attribute se nepodařilo nahrát.',
    'url' => ':attribute musí být validní URL.',
    'uuid' => ':attribute musí být valdiní UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'projectName' => 'Název projektu',
        'projectDescription' => 'Popis projektu',
        // @todo

    ],

];
