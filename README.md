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
### 

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
