#!/bin/sh

###################################################

###################################################

cb_admin_user=`cat /run/secrets/cb_admin_user`
cb_admin_pass=`cat /run/secrets/cb_admin_pass`

cb_bucket_user=`cat /run/secrets/cb_bucket_user`
cb_bucket_pass=`cat /run/secrets/cb_bucket_pass`

if /opt/couchbase/bin/couchbase-cli bucket-list -c 127.0.0.1 -u $cb_admin_user -p cb_admin_pass | grep -q 'ERROR'; then
	echo "there was an error, attempting setup"

	/opt/couchbase/bin/couchbase-cli cluster-init --cluster-username=$cb_admin_user --cluster-password=$cb_admin_pass --cluster-ramsize=1024 --cluster-index-ramsize=256 --services=data,index,query,fts

	/opt/couchbase/bin/couchbase-cli bucket-create -c 127.0.0.1 -u $cb_admin_user -p $cb_admin_pass --bucket data --bucket-type couchbase --bucket-ramsize 256 --enable-flush 0
	/opt/couchbase/bin/couchbase-cli bucket-create -c 127.0.0.1 -u $cb_admin_user -p $cb_admin_pass --bucket sessions --bucket-type couchbase --bucket-ramsize 256 --enable-flush 1
	/opt/couchbase/bin/couchbase-cli bucket-create -c 127.0.0.1 -u $cb_admin_user -p $cb_admin_pass --bucket compiled --bucket-type couchbase --bucket-ramsize 256 --enable-flush 1

	/opt/couchbase/bin/couchbase-cli user-manage -c 127.0.0.1 -u $cb_admin_user -p $cb_admin_pass --set --rbac-username $cb_bucket_user --rbac-password $cb_bucket_pass --auth-domain local --roles bucket_full_access[*]

        sleep 20

        /opt/couchbase/bin/cbq -u admin -p password -s "create primary index idx_data on \`data\`;"
        /opt/couchbase/bin/cbq -u admin -p password -s "create primary index idx_session on \`sessions\`;"
        /opt/couchbase/bin/cbq -u admin -p password -s "create primary index idx_compiled on \`compiled\`;"
fi