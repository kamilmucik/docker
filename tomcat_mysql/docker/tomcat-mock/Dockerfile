FROM centos

MAINTAINER k.mucik@e-strix.pl

RUN mkdir /opt/tomcat/

WORKDIR /opt/tomcat

RUN curl -O https://archive.apache.org/dist/tomcat/tomcat-8/v8.5.55/bin/apache-tomcat-8.5.55.tar.gz
RUN tar zxvf apache*.tar.gz
RUN mv apache-tomcat-8.5.55/* /opt/tomcat/.
RUN rm -rf /opt/tomcat/webapps/*

RUN yum -y install java-1.8.0-openjdk
RUN yum -y install less
RUN yum -y install vim

WORKDIR /opt/tomcat/webapps

EXPOSE 8080 8443

CMD ["/opt/tomcat/bin/catalina.sh", "run"]
