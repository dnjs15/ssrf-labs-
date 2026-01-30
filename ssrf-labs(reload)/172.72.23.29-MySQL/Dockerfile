# 使用官方支持的mysql:8.0.44-debian（底层Debian 12 Bookworm）
FROM mysql:8.0.44-debian

# 8.0适配：保留漏洞复现所需的环境变量（警告可忽略）
ENV MYSQL_ALLOW_EMPTY_PASSWORD="yes"
ENV MYSQL_DEFAULT_AUTH="mysql_native_password"

# 核心修改：替换为阿里云Debian 12源，移除不稳定的bookworm-updates
RUN echo "deb http://mirrors.aliyun.com/debian/ bookworm main contrib non-free" > /etc/apt/sources.list \
    && echo "deb http://mirrors.aliyun.com/debian-security/ bookworm-security main contrib non-free" >> /etc/apt/sources.list \
    # 执行apt-get操作，添加容错参数解决未签名/502问题
    && apt-get update --allow-unauthenticated \
    && apt-get install -y --no-install-recommends curl tcpdump \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 8.0适配：兼容5.x配置文件和SQL语法
COPY ./config/mysqld.cnf /etc/mysql/mysql.conf.d/
RUN echo "sql_mode=NO_ENGINE_SUBSTITUTION,STRICT_TRANS_TABLES" >> /etc/mysql/mysql.conf.d/mysqld.cnf

# 保留漏洞复现关键文件
COPY ./data/db.sql /docker-entrypoint-initdb.d/
COPY ./service/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 3306