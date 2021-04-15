# I. Cài đặt Timber Theme

### 1. Cài đặt Composer và Git
- Composer dùng để cài package Timber và các package khác của PHP.
- Git dùng để quản lý source, lưu trữ source và làm việc nhóm.
### 2. Tải theme
        git clone https://github.com/minhtrungs/wp-theme-timber
### 3. Cài package
        composer install

# II. Cấu trúc của Timber Theme
#### function.php
Cũng như các theme wp thông thường các chức năng chính sẽ được khai báo tại file function.php

# III. Sử dụng twig trong view
### 1. Cú pháp thường dùng
### 2. 
## 5. Các function hay sử dụng
- Add Shortcode
        {{ function('do_shortcode', '[contact-form-7 id="%s"]' | format(post.id)) }}
