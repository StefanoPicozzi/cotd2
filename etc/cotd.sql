
DROP TABLE items;

CREATE TABLE items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    theme VARCHAR(50),
    rank INTEGER,
    trivia TEXT,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);  

INSERT INTO items (name, theme, rank, trivia, created)
VALUES
('adelaide', 'cats', 1, '<p>My name is Le Cornu and I live in Adelaide. My dad plays for the Adelaide Crows. He has a big mullet which I snuggle into when he is asleep. <small>Rate me and we can watch the footie together. </small></p>', 
 NOW());

INSERT INTO items (name, theme, rank, trivia, created)
VALUES
('melbourne', 'cats', 2, '<p>My name is Rialto and my house is in Melbourne. I like to go to Philosophy Meetups. My favourite is Descates. He said: I think therefore I cat. <small>Rate me and we can workshop your existential mid-life crisis over some wine and cheese.</small></p>',
 NOW());

INSERT INTO items (name, theme, rank, trivia, created)
VALUES
('sydney', 'cats', 3, '<p>My name is Seidler and I am from Sydney. I do not go out at night any more since they implemented the lock out laws. <small>Rate me and we can talk about Sydney property prices.</small></p>',
 NOW());

INSERT INTO items (name, theme, rank, trivia, created)
VALUES
('brisbane', 'cats', 4, '<p>My name is Gabba and I am from Brisbane. I love it here because the floods bring fish straight to my door step. <small>Rate me and we can go fishing together.</small></p>',
 NOW());

INSERT INTO items (name, theme, rank, trivia, created)
VALUES
('perth', 'cats', 5, '<p>My name is Cottlesloe and I was born in Perth. My parents work FIFO at the mines so I do not get to see them much. <small>Rate me and I can stay with you every second week.</small></p>', 
 NOW());

INSERT INTO items (name, theme, rank, trivia, created)
VALUES
('hobart', 'cats', 6, '<p>My name is Mona and I am in Hobart. There is not much to do here so thank goodness for the NBN. <small>Rate me and we can watch youtube cat videos using broadband.</small></p>',
 NOW());

INSERT INTO items (name, theme, rank, trivia, created)
VALUES
('canberra', 'cats', 7, '<p>My name is Burley and my post office box is in Canberra. The Government appointed me into a senior position at the Human Rights Commission. <small>Rate me and we can obsess over repealing section 18C together.</small></p>',
 NOW());

INSERT INTO items (name, theme, rank, trivia, created)
VALUES
('auckland', 'cats', 8, '<p>My name is Ponsonby and I live in Auckland. I made a satellite launch vehicle using a ball of wool, 3 paper clips and a tub of bees wax. <small>Rate me and we can build a mud brick metropolis together.</small></p>',
 NOW());

INSERT INTO items (name, theme, rank, trivia, created)
VALUES
('wellington', 'cats', 9, '<p>My name is Massey and I am in Wellington. I am a contender for Secretary General of the United Nations. <small>Rate me unless you rather it be Kevin Rudd.</small></p>',
 NOW());

INSERT INTO items (name, theme, rank, trivia, created)
VALUES
('christchurch', 'cats', 10, '<p>My name is Twizel and I from Christchurch. I had a bit role in the Lord of the Rings trilogy, but so did everyone else. <small>Rate me and we can geek out on LOTR trivia for hours on end. </small></p>',
 NOW());
    

                    
