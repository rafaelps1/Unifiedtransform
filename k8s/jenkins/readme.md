#Deployment Jenkins in GKE withe Helm
##References:
1.0 - https://www.jenkins.io/doc/book/installing/kubernetes/
2.0 - https://faun.pub/jenkins-on-google-kubernetes-engine-gke-with-helm-a74c12cb7e64
2.1 - https://cloud.google.com/architecture/jenkins-on-kubernetes-engine-tutorial?hl=pt-br

##Create a namespace
$ kubectl create namespace jenkins

##Configure Helm
$ helm repo add jenkinsci https://charts.jenkins.io 
$ helm repo update

##Create Persiste Volume
Create a volume on GCP
And copy that resource

##Clusterrolebinding
*(For GKE: https://faun.pub/jenkins-on-google-kubernetes-engine-gke-with-helm-a74c12cb7e64)
###To give yoursefl cluster administrator permission in the cluster’s RBAC 
$  kubectl create clusterrolebinding cluster-admin-role --clusterrole=cluster-admin --user=$(gcloud config get-value account) --dry-run='client' -o yaml > cluster-admin-role.yaml

##Install Jenkins
###get the values to charts and create the jenkins-values.yaml
https://github.com/jenkinsci/helm-charts/blob/main/charts/jenkins/values.yaml

###run that to install:
$ chart=jenkinsci/jenkins
$ helm install jenkins -f k8s/jenkins/jenkins-values.yaml $chart

##Service Account
###Configure the Jenkins service account (as) to be able to deploy to the cluster
$ kubectl create clusterrolebinding jenkins-deploy --clusterrole=cluster-admin ###serviceaccount=default:jenkins --dry-run='client' -o yaml > k8s/jenkins/jenkins-deploy.yaml

###get password for admin
$ printf $(kubectl get secret jenkins -o jsonpath="{.data.jenkins-admin-password}" | base64 --decode);echo 
ctvB1Mq9ydL70kH3SkiHfG

$ jsonpath="{.data.jenkins-admin-password}” 
$ secret=$(kubectl get secret -n jenkins jenkins -o jsonpath=$jsonpath) 
$ echo $(echo $secret | base64 --decode)
