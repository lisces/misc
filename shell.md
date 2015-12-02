* ps aux | grep '[t]est' | awk '{print $2}' | xargs kill -15
* ip addr show | grep inet | grep -v '127.0.0.1' | grep -v 'inet6' | awk '{print $2}' | cut -f1 -d/
* sh tesh.sh | tee /tmp/test.log

