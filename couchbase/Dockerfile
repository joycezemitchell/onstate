FROM centos:7

COPY scripts/install.sh /install.sh


RUN chmod +x /install.sh && \
yum install -y pkgconfig wget openssl && \
wget https://packages.couchbase.com/releases/6.0.0/couchbase-server-community-6.0.0-centos7.x86_64.rpm && \
rpm --install couchbase-server-community-6.0.0-centos7.x86_64.rpm

CMD ["/opt/couchbase/bin/couchbase-server"]