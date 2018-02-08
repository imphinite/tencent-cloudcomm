<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SDK App ID
    |--------------------------------------------------------------------------
    |
    | Will be used for all web services for Tencent to identify your App,
    | unless overwritten bellow using 'sdkappid' parameter
     */

    'sdkappid'          => 'YOUR APP ID',

    /*
    |--------------------------------------------------------------------------
    | 用户名 Identifier
    |--------------------------------------------------------------------------
    |
    | Will be used for web services that require Admin authentication,
    | unless overwritten bellow using 'identifier' parameter
    |
     */

    'identifier'          => 'YOUR APP ADMIN IDENTIFIER',

    /*
    |--------------------------------------------------------------------------
    | 用户签名 UserSig
    |--------------------------------------------------------------------------
    |
    | Will be used for all web services that require Admin authentication, 
    | unless overwritten bellow using 'usersig' parameter
    |
    | For stand-alone mode(独立模式) usage, refer to "Generate UserSig under 
    | Linux" or "Generate UserSig under Windows". For tencent-hosted mode(托管模式)
    | usage, refer to "Download UserSig" in Tencent Cloud Console(腾讯云管理台).
    |
    */
    
    'usersig'           => 'YOUR ADMIN USERSIG',

    /*
    |--------------------------------------------------------------------------
    | 服务API端口 Service URL
    |--------------------------------------------------------------------------
    | url - web service URL
    | type - request type POST or GET
    | key - API OAuth key, if different to key above
    | responseDefaultKey - specify default field value to be retruned when calling getByKey()
    | param - accepted request parameters
    |
    */

    'url'               => 'https://console.tim.qq.com/v4',
    'service'           => [

        /*
        |--------------------------------------------------------------------------
        | 1 账号管理 Account Management
        |--------------------------------------------------------------------------
        | 独立模式账号导入 -- Stand-alone account import
        | 独立模式帐号批量导入 -- Stand-alone batch account import
        | 托管模式帐号导入 -- Tencent-hosted account registration
        | 失效帐号登录态 -- Set account invalid
        |
        */

        /**
         * 独立模式账号导入 -- Stand-alone account import
         * 
         */
        'import-acount' => [
            'endpoint'              => '/im_open_login_svc/account_import',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Identifier'            => null,
                'Nick'                  => null,
                'FaceUrl'               => null,
                'Type'                  => null,
            ]
        ],
        
        /**
         * 独立模式账号批量导入 -- Stand-alone batch account import
         * 
         */
        'batch-import-account' => [
            'endpoint'              => '/im_open_login_svc/multiaccount_import',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => 'events',
            'param'                 => [
                'Accounts'              => null,  // array
            ]
        ],

        /**
         * 托管模式账号导入 -- Tencent-hosted account registration (let Tencent handle your app's accounts)
         * 
         */
        'register-account' => [
            'endpoint'              => '/registration_service/register_account_v1',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Identifier'            => null,
                'IdentifierType'        => null,
                'Password'              => null,
            ]
        ],

        /**
         * 失效帐号登陆态 -- Set account invalid
         * 
         */
        'kick' => [
            'endpoint'              => '/im_open_login_svc/kick',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Identifier'            => null,
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | 2 单聊消息 Send Message
        |--------------------------------------------------------------------------
        | 单发单聊消息 -- Send one message
        | 批量发单聊消息 -- Send one message to many users
        | 导入单聊消息 -- Import message
        |
        */

        /**
         * 单发单聊消息 -- Send one message
         * 
         */
        'send-msg' => [
            'endpoint'              => '/openim/sendmsg',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'SyncOtherMachine'      => null,
                'From_Account'          => null,
                'To_Account'            => null,  // array
                'MsgLifeTime'           => null,
                'MsgRandom'             => null,
                'MsgTimeStamp'          => null,
                'MsgBody'               => [
                    'MsgType'               => null,
                    'MsgContent'            => [
                        'Text'                  => null,
                    ],
                    // [ ..] ..
                ],
                'OfflinePushInfo'       => [
                    'PushFlag'              => null,
                    'Desc'                  => null,
                    'Ext'                   => null,
                    'AndroidInfo'           => [
                        'Sound'                 => null,
                    ],
                    'ApnsInfo'              => [
                        'Sound'                 => null,
                        'BadgeMode'             => null,
                        'Title'                 => null,
                        'SubTitle'              => null,
                        'Image'                 => null,
                    ],
                ],
            ]
        ],


        /**
         * 批量发单聊消息 -- Send one message to many users
         * 
         */
        'batch-send-msg' => [
            'endpoint'              => '/openim/batchsendmsg',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'SyncOtherMachine'      => null,
                'From_Account'          => null,
                'To_Account'            => null,  // array
                'MsgRandom'             => null,
                'MsgBody'               => [
                    'MsgType'               => null,
                    'MsgContent'            => [
                        'Text'                  => null,
                    ],
                ],
                'OfflinePushInfo'       => [
                    'PushFlag'              => null,
                    'Desc'                  => null,
                    'Ext'                   => null,
                    'AndroidInfo'           => [
                        'Sound'                 => null,
                    ],
                    'ApnsInfo'              => [
                        'Sound'                 => null,
                        'BadgeMode'             => null,
                        'Title'                 => null,
                        'SubTitle'              => null,
                        'Image'                 => null,
                    ],
                ],
            ]
        ],


        /**
         * 导入单聊消息 -- Import message
         * 
         */
        'import-msg' => [
            'endpoint'              => '/openim/importmsg',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'SyncFromOldSystem'     => null,
                'From_Account'          => null,
                'To_Account'            => null,  // array
                'MsgRandom'             => null,
                'MsgTimeStamp'          => null,
                'MsgBody'               => [
                    'MsgType'               => null,
                    'MsgContent'            => [
                        'Text'                  => null,
                    ],
                ],
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | 3 消息推送 Push Notifications -- NOT FREE! Rate at 2000 RMB/Month as of 2018-02-07
        |--------------------------------------------------------------------------
        | 推送 -- Push
        | 获取推送报告 -- Get push report
        | 设置应用属性名称 -- Set attribute name
        | 获取应用属性名称 -- Get attribute name
        | 设置用户属性 -- Set user attribute
        | 删除用户属性 -- Delete user attribute
        | 获取用户属性 -- Get user attribute
        | 添加用户标签 -- Add tag to user
        | 获取用户标签 -- Get user tags
        | 删除用户标签 -- Delete tag of user
        | 删除用户所有标签 -- Delete all tags of user
        |
        */

        /**
         * 推送 -- Push
         * 
         */
        'push' => [
            'endpoint'              => '/openim/im_push',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Condition'             => [
                    'AttrsOr'               => [
                        '会员等级'              => null,
                        'city'                 => null,
                    ],
                    'AttrsAnd'              => [
                        '会员等级'              => null,
                        'city'                 => null,
                    ],
                    'TagsOr'                => [
                        '会员等级'              => null,
                        'city'                 => null,
                    ],
                    'TagsAnd'               => [
                        '会员等级'              => null,
                        'city'                 => null,
                    ],
                ],
                'From_Account'          => null,
                'MsgLifeTime'           => null,
                'MsgRandom'             => null,
                'MsgBody'               => [
                    'MsgType'               => null,
                    'MsgContent'            => [
                        'Text'                  => null,
                    ],
                ],

            ]
        ],
        
        /**
         * 获取推送报告 -- Get push report
         * 
         */
        'get-push-report' => [
            'endpoint'              => '/openim/im_get_push_report',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'TaskId'                => null,
                'TaskIds'               => null,  // array
            ]
        ],

        /**
         * 设置应用属性名称 -- Set app attribute names
         * 
         */
        'set-app-attr' => [
            'endpoint'              => '/openim/im_set_attr_name',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'AttrNames'             => [  // key-value array
                    '0'                     => null,
                    '1'                     => null,
                    '2'                     => null,
                ],
            ]
        ],

        /**
         * 获取应用属性名称 -- Get app attribute names
         * 
         */
        'get-app-attr' => [
            'endpoint'              => '/openim/im_get_attr_name',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => null
        ],

        /**
         * 设置用户属性 -- Set user attribute
         * 
         */
        'set-user-attr' => [
            'endpoint'              => '/openim/im_set_attr',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                "UserAttrs"             => [
                    [
                        'To_Account'        => null,
                        "Attrs"             => [
                            "sex"               => null,
                            "city"              => null,
                        ]
                    ],
                    // [ ..] ..
                ]
            ]
        ],

        /**
         * 删除用户属性 -- Delete user attribute
         * 
         */
        'remove-user-attr' => [
            'endpoint'              => '/openim/im_remove_attr',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                "UserAttrs"             => [
                    [
                        'To_Account'        => null,
                        "Attrs"             => [
                            "sex"               => null,
                            "city"              => null,
                        ]
                    ],
                    // [ ..] ..
                ]
            ]
        ],

        /**
         * 获取用户属性 -- Get user attribute
         * 
         */
        'get-user-attr' => [
            'endpoint'              => '/openim/im_get_attr',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'To_Account'            => null  // array
            ]
        ],

        /**
         * 添加用户标签 -- Add tag to user
         * 
         */
        'add-user-tag' => [
            'endpoint'              => '/openim/im_add_tag',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                "UserTags"             => [
                    [
                        'To_Account'        => null,
                        "Tags"              => null  // array
                    ],
                    // [ ..] ..
                ]
            ]
        ],

        /**
         * 获取用户标签 -- Get user tags
         * 
         */
        'get-user-tag' => [
            'endpoint'              => '/openim/im_get_tag',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'To_Account'            => null  // array
            ]
        ],

        /**
         * 删除用户标签 -- Delete tag of user
         * 
         */
        'remove-user-tag' => [
            'endpoint'              => '/openim/im_remove_tag',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                "UserTags"             => [
                    [
                        'To_Account'        => null,
                        "Tags"              => null  // array
                    ],
                    // [ ..] ..
                ]
            ]
        ],

        /**
         * 删除用户所有标签 -- Delete all tags of user
         * 
         */
        'remove-all-user-tags' => [
            'endpoint'              => '/openim/im_remove_all_tags',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'To_Account'            => null  // array
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | 4 群组管理 Group Management
        |--------------------------------------------------------------------------
        | 获取APP中的所有群组 -- Get app group list
        | 创建群组 -- Create group
        | 获取群组详细资料 -- Get group detail information
        | 获取群成员详细资料 -- Get group member detail information
        | 修改群组基础资料 -- Modify group basic information
        | 增加群组成员 -- Add group member
        | 删除群组成员 -- Delete group member
        | 修改群组成员资料 -- Modify group member detail information
        | 解散群租 -- Destroy group
        | 获取用户所加入的群组 -- Get user's joined groups
        | 查询用户在群组中的身份 -- Get user's role in group
        | 批量禁言和取消禁言 -- Enable/disable chat restriction
        | 获取群组被禁言用户列表 -- Get users with chat restriction
        | 在群组中发送普通消息 -- Send group message
        | 在群组中发送系统通知 -- Send group system notification
        | 转让群组 -- Change group owner
        | 导入群基础资料 -- Import group basic information
        | 导入群消息 -- Import group messages
        | 导入群成员 -- Import group members
        | 设置成员未读消息计数 -- Set unread number of messages
        | 删除指定用户发送的消息 -- Delete group message by sender
        | 搜索群组 -- Search group
        | 拉取群漫游消息 -- Get simple group message
        |
        */

        /**
         * 获取APP中的所有群组 -- Get app group list
         * 
         */
        'get-appid-group-list' => [
            'endpoint'              => '/group_open_http_svc/get_appid_group_list',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Limit'                 => null,
                'Next'                  => null,
                'GroupType'             => null
            ]
        ],

        /**
         * 创建群组 -- Create group
         * 
         */
        'create-group' => [
            'endpoint'              => '/group_open_http_svc/create_group',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Owner_Account'         => null,
                'Type'                  => null,
                'GroupId'               => null,
                'Name'                  => null,
                'Introduction'          => null,
                'Notification'          => null,
                'FaceUrl'               => null,
                'MaxMemberCount'        => null,
                'ApplyJoinOption'       => null,
                'AppDefinedData'        => [ // array
                    [
                        'Key'               => null,
                        'Value'             => null
                    ],
                    // [ ..] ..
                ],
                'MemberList'            => [
                    [
                        'Member_Account'    => null,
                        'Role'              => null,
                        'AppMemberDefinedData'  => [
                            [
                                'Key'               => null,
                                'Value'             => null
                            ],
                            // [ ..] ..
                        ]
                    ],
                    // [ ..] ..
                ],
            ]
        ],

        /**
         * 获取群组详细资料 -- Get group detail information
         * 
         */
        'get-group-info' => [
            'endpoint'              => '/group_open_http_svc/get_group_info',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupIdList'           => null,  // array
                'ResponseFilter'        => null   // refer to Tencent documentation
            ]
        ],

        /**
         * 获取群成员详细资料 -- Get group member detail information
         * 
         */
        'get-group-member-info' => [
            'endpoint'              => '/group_open_http_svc/get_group_member_info',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'MemberInfoFilter'      => null,
                'MemberRoleFilter'      => null,
                'AppDefinedDataFilter_GroupMember'  => null,
                'Limit'                 => null,
                'Offset'                => null,
            ]
        ],

        /**
         * 修改群组基础资料 -- Modify group basic information
         * 
         */
        'modify-group-base-info' => [
            'endpoint'              => '/group_open_http_svc/modify_group_base_info',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'Name'                  => null,
                'Introduction'          => null,
                'Notification'          => null,
                'FaceUrl'               => null,
                'MaxMemberCount'        => null,
                'ApplyJoinOption'       => null,
                'AppDefinedData'        => [ // array
                    [
                        'Key'               => null,
                        'Value'             => null
                    ],
                    // [ ..] ..
                ],
            ]
        ],

        /**
         * 增加群组成员 -- Add group member
         * 
         */
        'add-group-member' => [
            'endpoint'              => '/group_open_http_svc/add_group_member',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'Silence'               => null,
                'MemberList'            => [ // array
                    [
                        'Member_Account'    => null,
                    ],
                    // [ ..] ..
                ],
            ]
        ],

        /**
         * 删除群组成员 -- Delete group member
         * 
         */
        'delete-group-member' => [
            'endpoint'              => '/group_open_http_svc/delete_group_member',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'Silence'               => null,
                'Reason'                => null,
                'MemberToDel_Account'   => null,  // array
            ]
        ],

        /**
         * 修改群组成员资料 -- Modify group member detail information
         * 
         */
        'modify-group-member-info' => [
            'endpoint'              => '/group_open_http_svc/modify_group_member_info',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'Member_Account'        => null,
                'Role'                  => null,
                'MsgFlag'               => null,
                'NameCard'              => null,
                'AppMemberDefinedData'  => [
                    [
                        "Key"               => null,
                        "Value"             => null
                    ],
                    // [ ..] ..
                ]
            ]
        ],

        /**
         * 解散群组 -- Destroy group
         * 
         */
        'destroy-group' => [
            'endpoint'              => '/group_open_http_svc/destroy_group',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
            ]
        ],

        /**
         * 获取用户所加入的群组 -- Get user's joined groups
         * 
         */
        'get-joined-group-list' => [
            'endpoint'              => '/group_open_http_svc/get_joined_group_list',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Member_Account'        => null,
                'Limit'                 => null,
                'Offset'                => null,
                'GroupType'             => null,
                "ResponseFilter"        => null,  // refer to Tencent documentation
            ]
        ],

        /**
         * 查询用户在群组中的身份 -- Get user's role in group
         * 
         */
        'get-role-in-group' => [
            'endpoint'              => '/group_open_http_svc/get_role_in_group',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'User_Account'          => null,  // array
            ]
        ],

        /**
         * 批量禁言和取消禁言 -- Enable/disable chat restriction
         * 
         */
        'restrict-chat' => [
            'endpoint'              => '/group_open_http_svc/forbid_send_msg',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'Members_Account'       => null,  // array
                'ShutUpTime'            => null,
            ]
        ],

        /**
         * 获取群组被禁言用户列表 -- Get users with chat restriction
         * 
         */
        'get-restricted-in-group' => [
            'endpoint'              => '/group_open_http_svc/get_group_shutted_uin',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
            ]
        ],

        /**
         * 在群组中发送普通消息 -- Send group message
         * 
         */
        'send-group-msg' => [
            'endpoint'              => '/group_open_http_svc/send_group_msg',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'Random'                => null,
                'MsgPriority'           => null,
                'MsgBody'               => [
                    [
                        "MsgType"           => null,
                        "MsgContent"        => [
                            "Text"              => null,
                            "Index"             => null,
                            "Data"              => null,
                        ]
                    ],
                    // [ ..] ..
                ],
                'From_Account'          => null,
                'OfflinePushInfo'       => null,
                'ForbidCallbackControl' => null,  // array, refer to Tencent documentation
            ]
        ],

        /**
         * 在群组中发送系统通知 -- Send group system notification
         * 
         */
        'send-group-system-notification' => [
            'endpoint'              => '/group_open_http_svc/send_group_system_notification',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'ToMembers_Account'     => null,  // array
                'Content'               => null,
            ]
        ],

        /**
         * 转让群组 -- Change group owner
         * 
         */
        'change-group-owner' => [
            'endpoint'              => '/group_open_http_svc/change_group_owner',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'NewOwner_Account'      => null,
            ]
        ],

        /**
         * 导入群基础资料 -- Import group basic information
         * 
         */
        'import-group' => [
            'endpoint'              => '/group_open_http_svc/import_group',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Owner_Account'         => null,
                'Type'                  => null,
                'GroupId'               => null,
                'Name'                  => null,
                'Introduction'          => null,
                'Notification'          => null,
                'FaceUrl'               => null,
                'MaxMemberCount'        => null,
                'ApplyJoinOption'       => null,
                'AppDefinedData'        => [ // array
                    [
                        'Key'               => null,
                        'Value'             => null
                    ],
                    // [ ..] ..
                ],
                'CreateTime'            => null,
            ]
        ],

        /**
         * 导入群消息 -- Import group messages
         * 
         */
        'import-group-msg' => [
            'endpoint'              => '/group_open_http_svc/import_group_msg',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'MsgList'               => [
                    'From_Account'          => null,
                    'SendTime'              => null,
                    'Random'                => null,
                    'MsgBody'               => [
                        [
                            "MsgType"           => null,
                            "MsgContent"        => [
                                "Text"              => null,
                                "Index"             => null,
                                "Data"              => null,
                            ]
                        ],
                        // [ ..] ..
                    ],
                    // [ ..] ..
                ],
            ]
        ],

        /**
         * 导入群成员 -- Import group members
         * 
         */
        'import-group-member' => [
            'endpoint'              => '/group_open_http_svc/import_group_member',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'MemberList'            => [
                    [
                        'Member_Account'    => null,
                        'Role'              => null,
                        'JoinTime'          => null,
                        'UnreadMsgNum'      => null,
                    ],
                    // [ ..] ..
                ],
            ]
        ],

        /**
         * 设置成员未读消息计数 -- Set unread number of messages
         * 
         */
        'set-unread-msg-num' => [
            'endpoint'              => '/group_open_http_svc/set_unread_msg_num',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'Member_Account'        => null,
                'UnreadMsgNum'          => null,
            ]
        ],

        /**
         * 删除指定用户发送的消息 -- Delete group message by sender
         * 
         */
        'delete-group-msg-by-sender' => [
            'endpoint'              => '/group_open_http_svc/delete_group_msg_by_sender',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'Sender_Account'        => null,
            ]
        ],

        /**
         * 搜索群组 -- Search group
         * 
         */
        'search-group' => [
            'endpoint'              => '/group_open_http_svc/search_group',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Content'               => null,
                'PageNum'               => null,
                'GroupPerPage'          => null,
                'ResponseFilter'        => [  // refer to Tencent documentation
                    'GroupBasePublicInfoFilter' => null,
                ]
            ]
        ],

        /**
         * 拉取群漫游消息 -- Get simple group message
         * 
         */
        'get-simple-group-msg' => [
            'endpoint'              => '/group_open_http_svc/group_msg_get_simple',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'GroupId'               => null,
                'ReqMsgNumber'          => null,
                'ReqMsgSeq'             => null,
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | 5 资料管理 Profile Picture Management
        |--------------------------------------------------------------------------
        | 拉取资料 -- Get profile picture
        | 设置资料 -- Set profile picture
        |
        */

        /**
         * 拉取资料 -- Get profile
         * 
         */
        'get-portrait' => [
            'endpoint'              => '/profile/portrait_get',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'To_Account'            => null,  // array
                'TagList'               => null,  // array
            ]
        ],

        /**
         * 设置资料 -- Set profile
         * 
         */
        'set-portrait' => [
            'endpoint'              => '/profile/portrait_set',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'ProfileItem'           => [  // refer to Tencent documentation
                    [
                        'Tag'               => null,
                        'Value'             => null
                    ]
                ]
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | 6 关系链管理 Chain Relationship Management (Friends/Blacklist/Groups)
        |--------------------------------------------------------------------------
        | 添加好友 -- Add friend
        | 导入好友 -- Import friend
        | 删除好友 -- Delete friend
        | 删除所有好友 -- Delete all friends
        | 校验好友 -- Check friend
        | 拉取好友 -- Get all friends
        | 拉取指定好友 -- Get list of designated friends
        | 添加黑名单 -- Add blacklist
        | 删除黑名单 -- Delete blacklist
        | 拉取黑名单 -- Get blacklist
        | 校验黑名单 -- Check blacklist
        | 添加分组 -- Add group
        | 删除分组 -- Delete group
        |
        */

        /**
         * 添加好友 -- Add friend
         * 
         */
        'add-friend' => [
            'endpoint'              => '/sns/friend_add',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'AddFriendItem'         => [  // array
                    [
                        'To_Account'            => null,
                        'Remark'                => null,
                        'GroupName'             => null,
                        'AddSource'             => null,
                        'AddWording'            => null,
                    ],
                    // [ ..] ..
                ],
                'AddType'               => null,
                'ForceAddFlags'         => null,
            ]
        ],

        /**
         * 导入好友 -- Import friend
         * 
         */
        'import-friend' => [
            'endpoint'              => '/sns/friend_import',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'AddFriendItem'         => [  // array
                    [
                        'To_Account'            => null,
                        'Remark'                => null,
                        'RemarkTime'            => null,
                        'GroupName'             => null,
                        'AddSource'             => null,
                        'AddWording'            => null,
                        'AddTime'               => null,
                        'CustomItem'            => [  // array
                            [
                                'Tag'               => null,
                                'Value'             => null
                            ],
                            // [ ..] ..
                        ],
                    ],
                    // [ ..] ..
                ],
                'AddType'               => null,
                'ForceAddFlags'         => null,
            ]
        ],

        /**
         * 删除好友 -- Delete friend
         * 
         */
        'delete-friend' => [
            'endpoint'              => '/sns/friend_delete',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'To_Account'            => null,  // array
                'DeleteType'            => null,  // refer to Tencent documentation
            ]
        ],

        /**
         * 删除所有好友 -- Delete all friends
         * 
         */
        'delete-all-friends' => [
            'endpoint'              => '/sns/friend_delete_all',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
            ]
        ],

        /**
         * 校验好友 -- Check friend
         * 
         */
        'check-friend' => [
            'endpoint'              => '/sns/friend_check',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'To_Account'            => null,  // array
                'CheckType'             => null,  // refer to Tencent documentation
            ]
        ],
        
        /**
         * 拉取好友 -- Get all friends
         * 
         */
        'get-all-friends' => [
            'endpoint'              => '/sns/friend_get_all',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'TimeStamp'             => null,
                'StartIndex'            => null,
                'TagList'               => null,  // array
                'LastStandardSequence'  => null,
                'GetCount'              => null,
            ]
        ],

        /**
         * 拉取指定好友 -- Get list of designated friends
         * 
         */
        'get-friend-list' => [
            'endpoint'              => '/sns/friend_get_list',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'To_Account'            => null,  // array
                'TagList'               => null,  // array
            ]
        ],

        /**
         * 添加黑名单 -- Add blacklist
         * 
         */
        'add-blacklist' => [
            'endpoint'              => '/sns/black_list_add',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'To_Account'            => null,  // array
            ]
        ],

        /**
         * 删除黑名单 -- Delete blacklist
         * 
         */
        'delete-blacklist' => [
            'endpoint'              => '/sns/black_list_delete',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'To_Account'            => null,  // array
            ]
        ],

        /**
         * 拉取黑名单 -- Get blacklist
         * 
         */
        'get-blacklist' => [
            'endpoint'              => '/sns/black_list_get',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'StartIndex'            => null,
                'MaxLimited'            => null,
                'LastSequence'          => null,
            ]
        ],

        /**
         * 校验黑名单 -- Check blacklist
         * 
         */
        'check-blacklist' => [
            'endpoint'              => '/sns/black_list_check',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'To_Account'            => null,  // array
                'CheckType'             => null,
            ]
        ],

        /**
         * 添加分组 -- Add group
         * 
         */
        'add-group' => [
            'endpoint'              => '/sns/group_add',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'GroupName'             => null,  // array
                'To_Account'            => null,  // array
            ]
        ],

        /**
         * 删除分组 -- Delete group
         * 
         */
        'delete-group' => [
            'endpoint'              => '/sns/group_delete',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'From_Account'          => null,
                'GroupName'             => null,  // array
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | 7 脏字管理 Chat Censor Management
        |--------------------------------------------------------------------------
        | 查询脏字 -- Search for censored words and phrases
        | 添加脏字 -- Add censored words or phrases
        | 删除脏字 -- Remove censored words or phrases
        |
        */

        /**
         * 查询脏字 -- Search for censored words and phrases
         * 
         */
        'get-censor' => [
            'endpoint'              => '/openim_dirty_words/get',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => null
        ],

        /**
         * 添加脏字 -- Add censored words or phrases
         * 
         */
        'add-censor' => [
            'endpoint'              => '/openim_dirty_words/add',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'DirtyWordsList'        => null,  // array
            ]
        ],

        /**
         * 删除脏字 -- Remove censored words or phrases
         * 
         */
        'delete-censor' => [
            'endpoint'              => '/openim_dirty_words/delete',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'DirtyWordsList'        => null,  // array
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | 8 数据下载 Data Download
        |--------------------------------------------------------------------------
        | 消息记录下载 -- Get message history
        |
        */

        /**
         * 消息记录下载 -- Get message history
         * 
         */
        'get-msg-history' => [
            'endpoint'              => '/open_msg_svc/get_history',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'ChatType'              => null,
                'MsgTime'               => null,
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | 9 在线状态 Online Status
        |--------------------------------------------------------------------------
        | 获取用户在线状态 -- Get user online status
        |
        */

        /**
         * 获取用户在线状态 -- Get user online status
         * 
         */
        'get-user-status' => [
            'endpoint'              => '/openim/querystate',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'To_Account'            => null  // array
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | 10 全局禁言管理 Global Chat Restriction Management
        |--------------------------------------------------------------------------
        | 设置全局禁言 -- Set global chat restriction
        | 查询全局禁言 -- Get global chat restriction
        |
        */

        /**
         * 设置全局禁言 -- Set global chat restriction
         *
         */
        'set-global-chat-restriction' => [
            'endpoint'              => '/openconfigsvr/setnospeaking',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Set_Account'            => null,
                'C2CmsgNospeakingTime'   => null,
                'GroupmsgNospeakingTime' => null,
            ]
        ],

        /**
         * 查询全局禁言 -- Get global chat restriction
         * 
         */
        'get-global-chat-restriction' => [
            'endpoint'              => '/openconfigsvr/getnospeaking',
            'type'                  => 'POST',
            'identifier'            => null,
            'usersig'               => null,
            'responseDefaultKey'    => null,
            'param'                 => [
                'Get_Account'            => null,
            ]
        ],


    ],

];
