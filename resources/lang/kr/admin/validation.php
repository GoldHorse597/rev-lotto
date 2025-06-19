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

    'accepted' => ':attribute 필드는 승인되어야 합니다.',
    'accepted_if' => ':attribute 필드는 :other 필드가 :value 일때 승인되어야 합니다.',
    'active_url' => ':attribute 필드는 유효한 URL이 아닙니다.',
    'after' => ':attribute 필드는 :date 이후의 날짜이어야 합니다.',
    'after_or_equal' => ':attribute 필드는 :date 와 같거나 이후의 날짜이어야 합니다.',
    'alpha' => ':attribute 필드는 문자만을 포함할수 있습니다.',
    'alpha_dash' => ':attribute 필드는 문자, 숫자, 대시, 밑줄만을 포함할수 있습니다.',
    'alpha_num' => ':attribute 필드는 문자, 숫자만을 포함할수 있습니다.',
    'array' => ':attribute 필드는 배열이어야 합니다.',
    'before' => ':attribute 필드는 :date 이전의 날짜이어야 합니다.',
    'before_or_equal' => ':attribute 필드는 :date 와 같거나 이전의 날짜이어야 합니다.',
    'between' => [
        'numeric' => ':attribute 필드는 최소 :min, 최대 :max 이어야 합니다.',
        'file' => ':attribute 필드는 최소 :min KB, :max KB 이어야 합니다.',
        'string' => ':attribute 필드는 최소 :min 문자, 최대 :max 문자이어야 합니다.',
        'array' => ':attribute 필드는 최소 :min 개, 최대 :max 개의 요소를 가질수 있습니다.',
    ],
    'boolean' => ':attribute 필드는 True 혹은 False 이어야 합니다.',
    'confirmed' => ':attribute 필드 재입력이 정확하지 않습니다.',
    'current_password' => '비밀번호가 일치하지 않습니다.',
    'date' => ':attribute 필드는 유효한 날짜가 아닙니다.',
    'date_equals' => ':attribute 필드는 :date 와 같은 날짜이어야 합니다.',
    'date_format' => ':attribute 필드는 :format 형식이어야 합니다.',
    'declined' => ':attribute 필드는 거절되어야 합니다.',
    'declined_if' => ':attribute 필드는 :other 필드가 :value 일때 거절되어야 합니다.',
    'different' => ':attribute 필드와 :other 필드는 서로 달라야 합니다.',
    'digits' => ':attribute 필드는 :digits 개의 숫자이어야 합니다.',
    'digits_between' => ':attribute 필드는 최소 :min 개, 최대 :max 개의 숫자이어야 합니다.',
    'dimensions' => ':attribute 필드의 이미지크기가 유효하지 않습니다.',
    'distinct' => ':attribute 필드는 중복된 값을 가지고 있습니다.',
    'email' => ':attribute 필드는 유효한 이메일이 아닙니다.',
    'ends_with' => ':attribute 필드는 다음의 문자열로 끝나야 합니다.: :values.',
    'enum' => ':attribute 필드는 유효하지 않습니다.',
    'exists' => ':attribute 필드는 이미 존재합니다.',
    'file' => ':attribute 필드는 파일이어야 합니다.',
    'filled' => ':attribute 필드는 값이 있어야 합니다.',
    'gt' => [
        'numeric' => ':attribute 필드는 :value 보다 커야 합니다.',
        'file' => ':attribute 필드는 :value KB 보다 커야 합니다.',
        'string' => ':attribute 필드는 :value 문자보다 길어야 합니다.',
        'array' => ':attribute 필드는 :value 개보다 많은 요소를 가져야 합니다.',
    ],
    'gte' => [
        'numeric' => ':attribute 필드는 :value 보다 같거나 커야 합니다.',
        'file' => ':attribute 필드는 :value KB 보다 같거나 커야 합니다.',
        'string' => ':attribute 필드는 :value 문자보다 같거나 길어야 합니다.',
        'array' => ':attribute 필드는 :value 개보다 같거나 많은 요소를 가져야 합니다.',
    ],
    'image' => 'attribute 필드는 이미지이어야 합니다.',
    'in' => ':attribute 필드는 유효하지 않습니다.',
    'in_array' => ':attribute 필드는 :other 에 존재하지 않습니다.',
    'integer' => ':attribute 필드는 옹근수이어야 합니다.',
    'ip' => ':attribute 필드는 유효한 IP 주소이어야 합니다.',
    'ipv4' => ':attribute 필드는 유효한 IPv4 주소이어야 합니다.',
    'ipv6' => ':attribute 필드는 유효한 IPv6 주소이어야 합니다.',
    'json' => ':attribute 필드는 유효한 JSON 문자열이어야 합니다.',
    'lt' => [
        'numeric' => ':attribute 필드는 :value 보다 작아야 합니다.',
        'file' => ':attribute 필드는 :value KB 보다 작아야 합니다.',
        'string' => ':attribute 필드는 :value 문자보다 적어야 합니다.',
        'array' => ':attribute 필드는 :value 개보다 적은 요소를 가져야 합니다.',
    ],
    'lte' => [
        'numeric' => ':attribute 필드는 :value 보다 같거나 작아야 합니다.',
        'file' => ':attribute 필드는 :value KB 보다 같거나 작아야 합니다.',
        'string' => ':attribute 필드는 :value 문자보다 같거나 적어야 합니다.',
        'array' => ':attribute 필드는 :value 개보다 같거나 적은 요소를 가져야 합니다.',
    ],
    'mac_address' => ':attribute 필드는 유효한 MAC 주소가 아닙니다.',
    'max' => [
        'numeric' => ':attribute 필드는 최대 :max 보다 클수 없습니다.',
        'file' => ':attribute 필드는 최대 :max KB 보다 클수 없습니다.',
        'string' => ':attribute 필드는 최대 :max 문자를 넘지 말아야 합니다.',
        'array' => ':attribute 필드는 최대 :max 개보다 많은 요소를 가질수 없습니다.',
    ],
    'mimes' => ':attribute 필드는 파일형식이 :values 이어야 합니다.',
    'mimetypes' => ':attribute 필드는 파일형식이 :values 이어야 합니다.',
    'min' => [
        'numeric' => ':attribute 필드는 최소 :min 이어야 합니다.',
        'file' => ':attribute 필드는 최소 :min KB 이어야 합니다.',
        'string' => ':attribute 필드는 최소 :min 문자이어야 합니다.',
        'array' => ':attribute 필드는 최소 :min 개의 요소를 가져야 합니다.',
    ],
    'multiple_of' => ':attribute 필드는 :value 의 배수이어야 합니다.',
    'not_in' => ':attribute 필드는 유효하지 않습니다.',
    'not_regex' => ':attribute 필드는 형식이 유효하지 않습니다.',
    'numeric' => ':attribute 필드는 수자이어야 합니다.',
    'password' => '비밀번호가 정확하지 않습니다.',
    'present' => ':attribute 필드는 필수입니다.',
    'prohibited' => ':attribute 필드는 금지되었습니다.',
    'prohibited_if' => ':attribute 필드는 :other 필드가 :value 일때 금지되어야 합니다.',
    'prohibited_unless' => ':attribute 필드는 :other 필드가 :values 에 없을때 금지되어야 합니다.',
    'prohibits' => ':attribute 필드는 :other 필드를 금지합니다.',
    'regex' => ':attribute 필드는 형식이 유효하지 않습니다.',
    'required' => ':attribute 필드는 필수입니다.',
    'required_array_keys' => ':attribute 필드는 다음의 항목들을 포함하여야 합니다.: :values.',
    'required_if' => ':attribute 필드는 :other 가 :value 일때 필수입니다.',
    'required_unless' => ':attribute 필드는 :other 가 :values 에 없으면 필수입니다.',
    'required_with' => ':attribute 필드는 :values 가 존재할때 필수입니다.',
    'required_with_all' => ':attribute 필드는 :values 가 존재할때 필수입니다.',
    'required_without' => ':attribute 필드는 :values 가 존재하지 않을때 필수입니다.',
    'required_without_all' => ':attribute 필드는 :values 중 어느 하나도 존재하지 않을때 필수입니다.',
    'same' => ':attribute 필드와 :other 필드는 서로 같지 않습니다.',
    'size' => [
        'numeric' => ':attribute 필드는 :size 이어야 합니다.',
        'file' => ':attribute 필드는 :size KB 이어야 합니다.',
        'string' => ':attribute 필드는 :size 문자이어야 합니다.',
        'array' => ':attribute 필드는 :size 개의 요소를 가져야 합니다.',
    ],
    'starts_with' => ':attribute 필드는 다음의 문자열로 끝나야 합니다.: :values.',
    'string' => ':attribute 필드는 문자열이어야 합니다.',
    'timezone' => ':attribute 필드는 유효한 타임존 이어야 합니다.',
    'unique' => ':attribute 필드는 이미 사용중입니다.',
    'uploaded' => ':attribute 필드는 업로드에 실패하였습니다.',
    'url' => ':attribute 필드는 형식이 유효하지 않습니다.',
    'uuid' => ':attribute 필드는 유효한 UUID 이어야 합니다.',

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

    'attributes' => [],

];
