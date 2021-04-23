# I. Cài đặt Timber Theme

### 1. Cài đặt Composer và Git
- Composer dùng để cài package Timber và các package khác của PHP.
- Git dùng để quản lý source, lưu trữ source và làm việc nhóm.
### 2. Tải theme
        git clone https://github.com/minhtrungs/wp-theme-timber
### 3. Cài package
        composer install

# II. Cấu trúc của Timber Theme
#### 1. function.php
Cũng như các theme wp thông thường các chức năng chính sẽ được khai báo tại file function.php
- Tạo class bất kỳ kế thừa class Timber\Site và khởi tạo nó

        class ThemeConfig extends Timber\Site {
                /** Add timber support. */
                public function __construct() {
                        new Config\Enqueue;
                        new Config\PostType;
                        new Config\Taxonomy;
                        parent::__construct();
                        add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
                        add_filter( 'timber/context', array( $this, 'add_to_context' ) );
                        add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
                }

                /**
                * Thiết lập các giá trị sẽ truyền vào mảng context
                * Sử dụng các giá trị này bằng phương thức Timber::context() tại các template như: archive, single, page, template-page...
                */
                public function add_to_context( $context ) {
                        /** 
                        * Menu sẽ được gọi qua key 'menu'. Không truyền đối số 'menuname' Timber sẽ khởi tạo menu mặc định 
                        * Mỗi key sẽ tương ứng với 1 menu, nếu muốn dùng menu nào thì cần khởi tạo đúng tên menu đó.
                        * */
                        $context['menu']  = new Timber\Menu();
                        /** Toàn bộ option được tạo bằng ACF sẽ được gọi thông qua key 'options' */
                        $context['options']  = get_fields('options');
                        //** Các thông số về tên site, url... sẽ được gọi thông qua key 'site' */
                        $context['site']  = $this;
                        
                        return $context;
                }

                /** Theme support, khởi tạo các tính năng thường dùng trong cms */
                public function theme_supports() {
                        // Add default posts and comments RSS feed links to head.
                        add_theme_support( 'automatic-feed-links' );

                        /** Cho phép hiển thị tiêu đề trên tab trình duyệt. */
                        add_theme_support( 'title-tag' );

                        /** Cho phép chọn thumbnail trong trang soạn thảo */
                        add_theme_support( 'post-thumbnails' );

                        /** Khai báo các thẻ html5 sẽ được sử dụng */
                        add_theme_support(
                                'html5',
                                array(
                                        'comment-form',
                                        'comment-list',
                                        'gallery',
                                        'caption',
                                )
                        );

                        /** Định dạng post */
                        add_theme_support(
                                'post-formats',
                                array(
                                        'aside',
                                        'image',
                                        'video',
                                        'quote',
                                        'link',
                                        'gallery',
                                        'audio',
                                )
                        );

                        /** Khởi tạo menu cho website, tên của menu mặc định luôn luôn là 'menus' */
                        add_theme_support( 'menus' );
                }

                /** Phương thức này dùng để khai báo các function hoặc filter muốn sử dụng trong view (twig) */
                public function add_to_twig( $twig ) {
                        $twig->addExtension( new Twig\Extension\StringLoaderExtension() );
                        /**
                        * Tạo custom filter để sử dụng trong twig 
                        * Ví dụ như filter chuyển tất cả các ký tự sau khoảng trống thành chữ in hoa
                        */
                        $twig->addFilter( new Twig\TwigFilter( 'filter_key', array( $this, 'filter_method' ) ) );
                        /**
                        * Khai báo hàm sẽ được gọi trong twig
                        * Cú pháp gọi hàm trong twig {{ callback_function() }}
                        */
                        $twig->addFunction( new Timber\Twig_Function( 'callback_function' ) );

                        return $twig;
                }

                /** Phương thức xử lý giá trị được filter gửi đến */
                public function filter_method( $text ) {
                        $text .= ' test!';
                        return $text;
                }
        }

# III. Sử dụng twig trong view
#### 1. Cú pháp thường dùng
- In ra giá trị bất kỳ

        {{ site.title }}
        {{ site.url }}
        {{ theme.link }}
        {{ option }}
- Tạo object post bằng post_id bất kỳ

        {% set post = Post(post_id) %}
- Tạo object term bằng term_id bất kỳ

        {% set term = Term(term_id) %}
- In ra tiêu đề của object post

        {{ post.title }}
        
- In ra thumbnail_id của object post
                
        {{ post.thumbnail }} 

- Có id thumbnail muốn lấy ra url của thumbnail

        {{ Image(post.thumbnail).src }}
        {{ Image(thumbnail_id).src }}
- Chuyển định dạng ảnh từ định dạng bất kỳ sang jpg

        {{ Image(thumbnail_id).src | tojpg }}
- Cắt ảnh theo size mong muốn

        {{ Image(thumbnail_id).src | tojpg | resize(300, 200, 'center') }}
- Comment trong twig

        {# Nội dung muốn comment #}
#### 2. Biểu thức điều kiện
        {% if something %}
                {# làm gì đó #}
        {% elseif something == 1 %}
                {# làm gì đó #}
        {% else %}
                {# làm gì đó #}
        {% endif %}
#### 3. Duyệt mảng trong twig - Vòng lặp for (tương tự foreach trong php)
        {% for post in posts %}
                <a href="{{ post.link }}">{{ post.title }}</a>
        {% endfor %}
#### 4. Sử dụng function trong twig
        {{ function('do_shortcode', '[contact-form-7 id="%s"]' | format(post.id)) }}
        {# format là filter để gắn biến vào chuỗi tương tự khi sử dụng print #}
#### 5. Kế thừa view
        {% extends "base.html" %}

        {% block content %}
                {# Nội dung muốn hiển thị #}
        {% endblock %}

- Khi khai báo extend 1 file khác thì file hiện tại sẽ kế thừa toàn bộ thuộc tính của file đó.
- Trong file base thường có các block, ví dụ như block content. Nếu trong file hiện tại cũng khai báo block content thì block content trên file base.html sẽ bị ghi đè.
#### 6. Nhúng 1 file khác vào template hiện tại (sử dụng include)
- Nhúng 1 file thông thường như menu:

        {% include 'base/menu.twig' %}
- Nhúng 1 file gán kèm tham số

         {% include 'partial/pagination.twig' with { pagination: posts.pagination({show_all: false, mid_size: 3, end_size: 2}) } %}