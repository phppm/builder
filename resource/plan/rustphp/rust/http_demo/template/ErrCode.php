<?php
namespace wzrb\exceptions;
/**
 * Class AppErrCode
 *
 * @package wzrb\exceptions
 */
final Class AppErrCode {
    const NONE = 0; //无异常
    //公共异常
    const PARAMETER_INVALID = 10000;
    //认证相关
    #无认证头
    const NO_AUTHORIZATION_HEADER = 10001;
    #Token未找到
    const TOKEN_NOT_FOUND = 10002;
    #Token过期
    const TOKEN_HAS_EXPIRED = 10003;
    #Token异常
    const TOKEN_INVALID = 10004;
    #用户不存在
    const TOKEN_USER_NOT_FOUND = 10005;
    #
    const TOKEN_BEFORE_INVALID = 10006;
    #Token签名异常
    const TOKEN_SIGN_INVALID = 10007;
    #认证失败
    const AUTHORIZATION_FAILED = 10008;
    //--账户相关
    #ERROR CODE
}