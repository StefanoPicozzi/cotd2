
oc login -u system:admin
oc delete project cicd
sleep 10
oc delete project development
sleep 10
oc delete project testing
sleep 10

oc login -u developer -p developer
oc new-project cicd --display-name='CICD Jenkins' --description='CICD Jenkins'
sleep 10
oc new-project development --display-name='Development' --description='Development Environment' 
sleep 10
oc new-project testing --display-name='Testing' --description='Testing Environment' 
sleep 10

oc policy add-role-to-user edit system:serviceaccount:cicd:jenkins -n development 
oc policy add-role-to-user edit system:serviceaccount:cicd:jenkins -n testing 
oc policy add-role-to-group system:image-puller system:serviceaccounts:testing -n development

oc login -u developer -p developer
oc project development
oc delete all -l name=cats
oc new-app --name='cats' -l name='cats' php~https://github.com/StefanoPicozzi/cotd.git -e SELECTOR=cats
oc expose service cats --name=cats -l name='cats'
oc delete all -l name=cities
oc new-app --name='cities' -l name='cities' php~https://github.com/StefanoPicozzi/cotd.git -e SELECTOR=cities
oc expose service cities --name=cities -l name='cities'
sleep 10

oc login -u system:admin
oc project default
oc get services docker-registry
export REGISTRY_IP=`oc get services docker-registry --no-headers | cut -c 19-32`

sleep 5
echo $REGISTRY_IP
sleep 5

oc login -u developer -p developer
oc project testing

oc delete dc cats
oc delete service cats
oc delete route cats
oc create dc cats --image=`echo $REGISTRY_IP`:5000/development/cats:promoteQA
oc deploy cats --cancel
oc expose dc cats --port=8080
oc env dc/cats SELECTOR=cats
oc set triggers dc/cats --from-config --remove
oc expose svc cats
oc patch dc/cats -p '{"spec":{"template":{"spec":{"containers":[{"name":"default-container","imagePullPolicy":"Always"}]}}}}'

oc delete dc cities
oc delete service cities
oc delete route cities
oc create dc cities --image=`echo $REGISTRY_IP`:5000/development/cities:promoteQA
oc deploy cities --cancel
oc expose dc cities --port=8080
oc env dc/cities SELECTOR=cities
oc set triggers dc/cities --from-config --remove
oc expose svc cities
oc patch dc/cities -p '{"spec":{"template":{"spec":{"containers":[{"name":"default-container","imagePullPolicy":"Always"}]}}}}'

oc project cicd
oc delete all -l name='jenkins'
oc new-app --template=jenkins-ephemeral -l name='jenkins' -p  JENKINS_IMAGE_STREAM_TAG=jenkins:latest,NAMESPACE=openshift,MEMORY_LIMIT=2048Mi,JENKINS_PASSWORD=password
oc status
sleep 10

oc delete -f cotd/etc/cotdcicdpipeline.yaml
oc create -f cotd/etc/cotdcicdpipeline.yaml
oc start-build cotdcicdpipeline

