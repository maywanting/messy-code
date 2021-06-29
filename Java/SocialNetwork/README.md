# Social Network

The goal of this assignment is to create a social network simulation.
This social network is composed of 3 entities:
- A network
- The users
- The messages

In this simple social network, a user can
- post a message
- read a message
- like a message

You will have to implement this social network using at least the 3 classes:
- User,
- Message,
- Network.

## Message

The Message class has to keep the information about a message and provide the methods to interact with this information.

The necessary information is defined by the following propositions:
- A message has an author: the user that posted the message.
- A message has a title: posted by the author.
- A message contains text data: the text posted by the author.
- A message has a counter to keep track of how many users read it.
- A message has a counter to keep track of how many users liked it.
- A message has a unique ID number.

There are some rules concerning messages:
1. A user can only like a message one time
2. The author cannot like the message

## User
The User class has to keep the information about a user and provide the methods to interact with this information.

The necessary information is defined by the following propositions:
- A user has a username. The username may not be unique
- A user has a counter for the number of message she/he posted
- A user has a popularity ranking. It is the total number of likes she/he gets on her/his messages
- A user has a unique ID number.

A user has some specific methods:
- A user can post a message
- A user can read a mesage
- A use can like a message

## Network

The Network class has to keep the information about a network and provide the methods to interact with this information.

The necessary information is defined by the following propositions:
1. The network has a user list
2. The network has a message list
3. The network has a most popular user
4. The network has a most liked message
5. The network has a most read message

The network is unique. There can be only one instance of it.
The network has a main method that we use to test the social network. It simulates the social network by:
1. Creating the network
2. Creating 4 users
3. Having the users post messages, read messages and like messages

In step 2 and 3, the program uses hard coded values for names, titles and texts (you can keep it simple if you want: user1, msg1, title1, text1, etc)

At each operations (user creation, user posting message, user reading message, user liking post) of the simulation, the network reports about the number of users, the number of messages, the most popular user, the most read message and the most popular message.

