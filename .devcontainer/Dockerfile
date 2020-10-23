FROM amazonlinux:2

RUN yum install -y glibc-langpack-ja && yum clean all && ln -sf /usr/share/zoneinfo/Japan /etc/localtime
RUN yum install -y \
    sudo shadow-utils tar zip unzip procps gcc make libaio libxml2 libxml2-devel libpng libpng-devel vim git wget \
    && yum clean all

ENV LANG="ja_JP.UTF-8" \
    LANGUAGE="ja_JP:ja" \
    LC_ALL="ja_JP.UTF-8"

RUN yum install -y httpd httpd-devel logrotate httpd-filesystem httpd-tools && yum clean all
RUN systemctl enable httpd.service
EXPOSE 80
EXPOSE 443
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

RUN amazon-linux-extras install epel
RUN yum install -y \
    php php-devel php-pear php-pecl-memcache php-pecl-xdebug php-xml php-mbstring php-pdo php-mcrypt php-gd \
    && yum clean all

COPY httpd.conf /etc/httpd/conf/httpd.conf
COPY php.ini /etc/php.ini

RUN mkdir /opt/oracle && cd /opt/oracle
ADD instantclient-basic-linux.x64-19.6.0.0.0dbru.zip /opt/oracle
ADD instantclient-sdk-linux.x64-19.6.0.0.0dbru.zip /opt/oracle
ADD instantclient-sqlplus-linux.x64-19.6.0.0.0dbru.zip /opt/oracle
RUN unzip /opt/oracle/instantclient-basic-linux.x64-19.6.0.0.0dbru.zip -d /opt/oracle
RUN unzip /opt/oracle/instantclient-sdk-linux.x64-19.6.0.0.0dbru.zip -d /opt/oracle
RUN unzip /opt/oracle/instantclient-sqlplus-linux.x64-19.6.0.0.0dbru.zip -d /opt/oracle
RUN rm -rf /opt/oracle/*.zip

ENV LD_LIBRARY_PATH=/opt/oracle/instantclient_19_6:${LD_LIBRARY_PATH}
ENV PATH=$PATH:/opt/oracle/instantclient_19_6
RUN echo 'extension=pdo_oci.so' >> /etc/php.d/pdo_oci.ini
RUN echo 'extension=oci8.so' >> /etc/php.d/oci8.ini
ADD php-5.4.16.tar.gz /tmp
RUN cd /tmp/php-5.4.16/ext/oci8    && phpize && ./configure --with-oci8=shared,instantclient,/opt/oracle/instantclient_19_6,11.2 && make && make install
RUN cd /tmp/php-5.4.16/ext/pdo_oci && phpize && ./configure --with-pdo_oci=shared,instantclient,/opt/oracle/instantclient_19_6,11.2 && make && make install

COPY httpd.conf /etc/httpd/conf/
COPY php.ini /etc/
COPY xdebug.ini /etc/php.d/
COPY tnsnames.ora /opt/oracle/instantclient_19_6/network/admin/

ENV ENVIRONMENT local
ENV NLS_LANG Japanese_Japan.AL32UTF8

#COPY xdebug.ini /etc/php.d/

#ENV environment local
#ENV NLS_LANG Japanese_Japan.AL32UTF8
