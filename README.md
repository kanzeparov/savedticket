# SaveTickets

## It's a monorepo for Android and Web apps, Smart Contracts and other utils.

# Structure

<ol type="1" style="font-size: x-large;">
<li> [Scheme] (#Repo-scheme)
<li> [About](#about)
<li> [Task: Extend the NuCypher Network](#task:-extend-the-nucypher-network)
<li> [Solution](#solution)
<ol type="a" style="font-size: large;">
  <li> [User application](#user-application)
  <li> [Homomorphic encryption](#homomorphic-encryption)
  <li> [Fully Homomorphic Encryption](#fully-homomorphic-encryption)
  <li> [Architecture](#a-hidden-pixel)
</ol>
<li> [Installation](#installation)
<ol type="a" style="font-size: large;">
  <li> [Frontend](#web-application)
  <li> [Backend](#android-application)
</ol>
<li> [Finally](#finally)
<li> [Team](#team)
</ol>



#   Repo scheme
```bash
.
├── android
│
├── android2
│
├── web
├── contracts
│   ├── contracts
│   │   └── Ticket721.sol
│   └── ctrl_server.py
│
└── README.md
```

<code>android</code> - android application for client (ticket owner).  

<code>android2</code> - android application for security staff. 

<code>web</code> - directory with web-utils (web-site, back-end and etc)

<code>contracts</code> - smart contracts, utils for interaction with Ethereum, staff for seats tracking

# About
The US ticket market for 2018 was $ 46.8 billion, and it is expected that the market will grow to $ 68 billion until 2023. Distributors sell 60 - 85% of tickets online. At the same time, the share of the secondary market is from 12 to 27% and is estimated at $ 15.6 billion (Grand View Research)
For example, during the World Cup 140,000 tickets were sold in the secondary market, worth more than $ 22 million (PwC)
One of the main problems is that tickets purchased on the secondary market aren't trustworthy. 
The issue of ticket counterfeiting leads to the fact that spectators cannot get to the event, and the organizers lose part of the profit and customer loyalty.
The share of fake tickets is on average 20%, as a result of which the profit not received by the organizers can reach hundreds of thousands of dollars per event. The annual loss of profit is estimated at $ 2-5 billion. (The Guardian).
A significant problem in the US market is the long confirmation of the availability of free space after ordering (up to 24 hours), due to the lack of a unified system for monitoring the status of tickets.

## Advantages of the proposed solution. ##
For event organizers:
<li> Increase profits by 20%
<li>  Open and reliable information about the ticket purchase history
<li>  Distributor and user database
<li>  A unified system with instant tracking of available tickets

For event visitors:
<li>  Guaranteed purchase of a genuine ticket
<li>  The ability to safely delegate a ticket (token) without financial loss
<li>  Receiving bonuses from the organizer provided that the required number of tickets has been distributed

# Solution
