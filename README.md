
# COTD: Cat of the Day

PHP web application using JQuery Mobile that publishes a list of ordered items. 
Each item has an image and trivia associated with it.

Item lists are organised as themes. The application looks for an environment variable known as SELECTOR to set the theme.
The default theme is SELECTOR="cats". By default, item content is sourced from the local data directory. 
If the environment variable SERVICE is set, the application will look for REST service at the IP address.

## Website

A sample running application is hosted on OpenShift Online V2.

    http://www.cotd.net.au

## Usage

The application is used to support the OpenShift MiniLabs series. 
Look here for example usage of this application.

    http://StefanoPicozzi.blog

## Configuration

Lists can be customed by editing the include/selector.php to point to set the theme of interest.
Edit the data/$theme.php file populate the data for that $theme.
Add images to the data/images/$theme subdirectory with names matching list items.

## Logging

Whenever the user rates an item, an entry is written to the php log.
These entries can be filtered and then used to test hypotheses regarding user engagement.
An example entry is as follows:

    [Sun Sep 25 09:14:40.037909 2016] [:error] [pid 15] [client 172.17.0.1:46572] <COTD> { "user" : "e299ra835usa88pp19sr25ipg6", items" : [ {"adelaide" : "1"}, {"canberra" : "3"}, ] , "client_ip" : "172.17.0.1",  "sydney_time" : "2016:09:25 19:14:40",  } </COTD>, referer: http://localhost:8080/item.php?nextpage=canberra

## AB Deployment Example

To experiment with an A/B deployment scenario, follow the instructions in the blog entry at: https://blog.emergile.com/2016/10/07/ab-deployments-made-easy-with-openshift/  

## Running using Docker Toolbox

    $ docker pull spicozzi/cotd
    $ docker run -d -i -p 8080:80 spicozzi/cotd
    Browser http://localhost:8080

## Running on Openshift3

    oc new-project cotd --display-name="City of the day" --description='City of the day'
    oc new-app openshift/php:5.6~https://github.com/<repo>/cotd.git
    oc expose svc cotd

## Developing on the fly in Openshift3

Edit the buildconfig:

    -- change from Git to binary
    source:
      type: Git
      git:
        uri: 'https://github.com/eformat/cotd.git'
      secrets: null

    -- to this
    source:
      type: Binary

    -- then build with
    oc start-build --from-dir=. cotd

You may also wish to enable live reload for php image (don't do this in prod)

    oc set env dc/cotd OPCACHE_REVALIDATE_FREQ=0

## Parse the pods running statistics

For now:

    ./parseCotdLogs.pl $(oc get pods | grep cotd | grep Running | awk '{print $1}')
