#!/usr/bin/perl
use Data::Dumper;
use strict;

sub usage {
    print {*STDERR} <<EOF
Usage: 
      Pod name specified as first argument:      

      $0 \$(oc get pods | grep cotd | grep Running | awk '{print \$1}')

EOF
}

my ($pod) = $ARGV[0];
die usage unless ($pod);

my $dump;
{
    local $/ = undef;
    $dump = `oc logs $pod`
}

my ($fav_by_client, $fav_by_city, $fav_city);

my $string = 'Favorite\ is';
while( $dump =~ m/] (.{0,35}$string.{0,30}),/gisx ) {
    # print "Found $1\n";
    # Found  10.1.0.1 121.208.243.85 --> Favorite is --> favorite=brisbane
    my ($router,$client,$city) = ($1 =~ /(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}) (\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}).*=(\w+)/);
    #print "$router : $client : $city\n";
    $fav_by_client->{$client}->{$city} += 1;
    $fav_by_city->{$city}->{$client} += 1;
    $fav_city->{$city} += 1;
}

print "Favourite by client.ip " . Data::Dumper->Dump([$fav_by_client],['$x']);
print "Favourite by city and client.ip " . Data::Dumper->Dump([$fav_by_city],['$x']);
print "Favourite by city " . Data::Dumper->Dump([$fav_city],['$x']);

#$string = 'Top\ city\ is';
#while( $dump =~ m/] (.{0,35}$string.{0,30}),/gisx ) {
#    # print "Found $1\n";
#    # Found  10.1.2.1 66.187.239.11 Top city is --> adelaide
#    my ($router,$client,$city) = ($1 =~ /(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}) (\d{1,3}\.\d{1,3#}\.\d{1,3}\.\d{1,3}).*> (\w+)/);
#    print "$router : $client : $city\n";
#}
