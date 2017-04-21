#!/bin/bash

begin=$(php -r "echo microtime(true);")

for i in `seq 1 $THREADS`
do
    php ./generator.php $i $DESTINATION $ITERATIONS &
done
wait

end=$(php -r "echo microtime(true);")

echo "Elapsed time: $(php -r "echo $end - $begin;")s with $DESTINATION storage.";
