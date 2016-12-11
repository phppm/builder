<?php
return [
    'findByAll'   => [
        'cache'   => 0, // -1 永不过期 | 0 不缓存 | > 0 cache Time
        'require' => [],//必填字段
        'limit'   => [],//可选字段
        'sql'     => 'SELECT #COLUMN# FROM version #WHERE# #GROUP# #ORDER# #LIMIT# ',//
    ],
    'findByState' => [
        'cache'   => 0, // -1 永不过期 | 0 不缓存 | > 0 cache Time
        'require' => [],//必填字段
        'limit'   => [],//可选字段
        'sql'     => 'SELECT id,name,type_id,ver,url,created_time,last_updated_time FROM version WHERE state=? #ORDER# #LIMIT# ',//
    ],
    'new'         => [
        'cache'   => 0, // -1 永不过期 | 0 不缓存 | > 0 cache Time
        'require' => [],//必填字段
        'limit'   => [],//可选字段
        'sql'     => 'INSERT INTO version #INSERT# ',//
    ],
    'update'      => [
        'require' => [],
        'limit'   => [],
        'sql'     => 'UPDATE version SET #DATA# WHERE id = ? LIMIT 1',
    ],
];