# Use centos as the base
FROM centos:latest
MAINTAINER Stefano Picozzi

RUN yum -y install epel-release
RUN yum -y install R
RUN yum -y install wget

RUN wget https://download2.rstudio.org/rstudio-server-rhel-1.0.44-x86_64.rpm
RUN yum -y install --nogpgcheck rstudio-server-rhel-1.0.44-x86_64.rpm

RUN yum -y install mysql ftp curl libcurl libcurl-devel libpng-devel mesa-libGL-devel mesa-libGLU-devel libpng-devel libxml2 libxml2-devel git openssl-devel

RUN useradd guest
RUN echo guest:guest | chpasswd

RUN useradd rstudio
RUN echo rstudio:rstudio | chpasswd

RUN useradd admin
RUN echo admin:admin | chpasswd

USER root
EXPOSE 8787
CMD /usr/lib/rstudio-server/bin/rserver --server-daemonize 0
