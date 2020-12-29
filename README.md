## 安装

```shell
$ composer require jncinet/qihucms-site-help
```

## 使用
### 数据迁移
```shell
$ php artisan migrate
```

### 发布资源
```shell
$ php artisan vendor:publish --provider="Qihucms\SiteHelp\SiteHelpServiceProvider"
```

### 后台菜单
+ 帮助分类：site-help/help-categories
+ 帮助内容：site-help/helps
+ 帮助回复：site-help/help-replies

## 接口
### 选择帮助文档
+ 请求方式：GET
+ 请求地址：site-help/select-helps?q=文档关键词
+ 返回值：
```
[
    {
        "id": 1,
        "text" "文档标题"
    },
    ...
]
```

### 帮助文档分页列表
+ 请求方式：GET
+ 请求地址：site-help/helps?id={帮助分类ID，默认为0读取所的文档}&limit={分页条数,可选}&page={页码,可选}
+ 返回值：
```
{
    "data": [
        {
            'id': 1,
            'category': {
                'id': 1,
                'name': "分类名",
                'ico': "http://图片地址",
                'desc': "分类简介",
            },
            'title': "标题",
            'desc': "简介",
            'thumbnail': "缩略图",
            'useful': 142, // 有用数
            'created_at': "3秒前",
            'updated_at': "1秒前",
        },
        ...
    ],
    "meta": {},
    "links": {}
}
```

### 帮助文档详细
+ 请求方式：GET
+ 请求地址：site-help/helps/{id={帮助文档ID}
+ 返回值：
```
{
    'id': 1,
    'category': {
        'id': 1,
        'name': "分类名",
        'ico': "http://图片地址",
        'desc': "分类简介",
    },
    'replies': {
        'id': 1,
        'user': {"id": 1, "username": "name", ...},
        'content': "评论回复",
        'reply': "回复内容",
        'created_at': "1小时前",
        'updated_at': "1分钟前",
    },
    'title': "标题",
    'desc': "概述",
    'thumbnail': "缩略图地址"
    'content': "帮助文档内容"
    'useful': 112, // 有用数
    'created_at' "1小时前",
    'updated_at': "1分钟前",
}
```

## 数据库
### 帮助分类表：site_help_categories
| Field             | Type      | Length    | AllowNull | Default   | Comment   |
| :----             | :----     | :----     | :----     | :----     | :----     |
| id                | bigint    |           |           |           |           |
| name              | varchar   | 55        |           |           | 分类名称   |
| desc              | varchar   | 255       | Y         | NULL      | 分类介绍   |
| ico               | varchar   | 255       | Y         | NULL      | 小图标     |
| sort              | int       |           |           | 0         | 分类排序    |
| status            | tinyint   |           |           | 1         | 分类状态    |
| created_at        | timestamp |           | Y         | NULL      | 创建时间    |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间    |

### 帮助内容表：site_helps
| Field             | Type      | Length    | AllowNull | Default   | Comment   |
| :----             | :----     | :----     | :----     | :----     | :----     |
| id                | bigint    |           |           |           |           |
| site_help_category_id | bigint |          |           |           | 所属分类   |
| title             | varchar   | 255       |           |           | 标题       |
| desc              | varchar   | 255       | Y         | NULL      | 概要       |
| thumbnail         | varchar   | 255       | Y         | NULL      | 缩略图     |
| content           | longtext  |           |           |           | 内容       |
| useful            | int       |           |           | 0         | 有用       |
| status            | tinyint   |           |           | 1         | 状态       |
| created_at        | timestamp |           | Y         | NULL      | 创建时间    |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间    |

### 帮助回复表：site_help_replies
| Field             | Type      | Length    | AllowNull | Default   | Comment   |
| :----             | :----     | :----     | :----     | :----     | :----     |
| id                | bigint    |           |           |           |           |
| site_help_id      | bigint    |           |           |           | 所属内容   |
| user_id           | bigint    |           |           |           | 发布人     |
| content           | text      |           |           |           | 评论内容   |
| reply             | text      |           |           |           | 回复内容   |
| status            | tinyint   |           |           | 1         | 状态       |
| created_at        | timestamp |           | Y         | NULL      | 创建时间    |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间    |
