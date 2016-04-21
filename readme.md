# General
## Overview
The Sabre API Code Samples for PHP project’s purpose is to provide the reference code and enable quick and easy start to consuming Sabre Webservices. It focuses on business case usage, so it shows how to chain several REST calls into a workflow, where the subsequent call uses the previous one’s result. Its structure is designed to easily reuse parts of the classes, whole classes, modules or even whole project in client’s applications.
## Configuring the application
The configuration is located in *SACSRestConfig.ini* file. It keeps the properties which are needed to connect and authenticate to the Sabre’s REST webservices. They are being read by the Configuration class, which contains the *getProperty()* which reads the value of the property.

Although the credentials are not encrypted right now to lower the project entry time, it is strongly recommended to use the encryption in production systems and do not keep the credentials in plain text.

Please register at https://developer.sabre.com in order to obtain your own credentials.

## Running the application
In the php.ini file, enable the following modules by uncommenting those lines:
extension=php_curl.dll
extension=php_mbstring.dll
extension=php_openssl.dll

## Quickstart “How to”
The workflow’s activities are written as implementation of the Activity interface from the *workflow* folder, which contains one abstract method *run()* which takes the shared context as the parameter. The implementation should construct the request object (or just setup the URL, like in the *InstaFlight* case), execute a rest call, insert the call’s result into the *sharedContext* and return the next activity to be run.

# Modules
## Configuration
This module provides configuration of REST webservice calls. It contains the endpoint address and credentials to connect there, which are not encrypted. The encryption and decryption methods should be included there.

## Rest
A class containing method used to communicate with Sabre’s REST webservices. The *RestClient* contains methods for GET and POST calls, which can be used to easily execute REST calls. It uses the *TokenHolder* class, which takes care of providing token to authenticate the call, which is obtained by executing the *Auth* class’ *callForToken()* method.

The main runnable script is also contained there and is named *Rest.py*.

## Activities
The package contains three implementations of the *Activity* interface used in the *Workflow* module. The *LeadPriceCalendarActivity* executes the GET call, the *InstaFlightActivity* uses a hypermedia link from the result of the *LeadPriceCalendar* call, and the *BargainFinderMaxActivity* runs a POST call.

## Workflow
Module used to run a sequence of activities. Each activities’ *run()* method returns the next activity to be run, until there is no more.

# Support

- [Stack Overflow](http://stackoverflow.com/questions/tagged/sabre "Stack Overflow")
- Need to report an issue/improvement? Use the built-in [issues] (https://github.com/SabreDevStudio/SACS-Php/issues) section
- [Sabre Dev Studio](https://developer.sabre.com/)

# Disclaimer of Warranty and Limitation of Liability
This software and any compiled programs created using this software are furnished “as is” without warranty of any kind, including but not limited to the implied warranties of merchantability and fitness for a particular purpose. No oral or written information or advice given by Sabre, its agents or employees shall create a warranty or in any way increase the scope of this warranty, and you may not rely on any such information or advice. Sabre does not warrant, guarantee, or make any representations regarding the use, or the results of the use, of this software, compiled programs created using this software, or written materials in terms of correctness, accuracy, reliability, currentness, or otherwise. The entire risk as to the results and performance of this software and any compiled applications created using this software is assumed by you. Neither Sabre nor anyone else who has been involved in the creation, production or delivery of this software shall be liable for any direct, indirect, consequential, or incidental damages (including damages for loss of business profits, business interruption, loss of business information, and the like) arising out of the use of or inability to use such product even if Sabre has been advised of the possibility of such damages.
