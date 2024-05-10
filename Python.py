user = input('enter name: ')
password = str(input('register password: '))
upassword = password
attempts = 5

while attempts >= 1:
   userpass = str(input('enter password: '))
   if userpass != upassword:
       print('incorrect password')
       attempts -= 1
   else:
       print('login successful')


       print("\nSAS 11, true or false")
       sas1 = { '1. A for loop enables a particular set of conditions to be executed repeatedly until a condition is satisfied.':'true', '2. It processes instructions a precise number of times.':'true',
                    '3. If a sequence contains an expression list, it is evaluated first.':'true', '4. An alternative way of iterating through each item is by index offset into the sequence itself.': 'true',
                     '5. Python does not support having an else statement associated with a loop statement':'false', '6. If the else statement is used with a for loop, the else statement is executed when the loop has exhausted iterating the list.': 'true',
                     '7. Python programming language does not allow using one loop inside another loop.': 'false', '8. A final note on loop nesting is that you cannot put any type of loop inside of any other type of loop.': 'false',
                     '9. An infinite loop is very useful in embedded systems.': 'true', '10. A loop that is never finished is known as an infinite loop, it means the looping condition is always true, so that loop never terminates.': 'true'}
       correct = 0
       incorrect = 0
       for x in sas1:
           answer_key = sas1[x]
           print(x)
           answer = input('type your answer: ')
           if answer == answer_key:
               print('correct!')
               correct += 1
           else:
               print('incorrect!')
       print(' ')
       print(correct, "/", 10)


       print("\nSAS 12, identification. Answer in uppercase only.")
       sas2 = {'1. The _____ statement is used inside the loop to exit out of the loop?':' BREAK ',
               '2. Allows you to bypass the current iteration of any _____':'LOOP',
               '3. It is considered a no-operation statement': 'PASS STATEMENT',
               '4. In a loop alter the execution _____':'SEQUENCE',
               '5. A _____ statement is also considered a no-operation statement':'PASS',
               '6. When a continuous statement is encountered in the _____, the Python interpreter ignores the rest of the loop body statements': 'LOOP',
               '7. The ____ statement is much like a comment':'PASS',
               '8. When execution _____ a scope, all automatic objects created in that scope are destroyed.':'EXITS',
               '9. It does not end the loop but rather moves on to the next ______':'ITERATION',
               '10. It is generally used to indicate ______ or unimplemented functions and loops.':'NULL'}

       correct = 0
       incorrect = 0
       for x in sas1:
           answer_key = sas1[x]
           print(x)
           answer = input('type your answer: ')
           if answer == answer_key:
               print('correct!')
               correct += 1
           else:
               print('incorrect!')
       print(' ')
       print(correct, "/", 10)

       print("\nSAS 13: 1-5, identification. 6-10, true or false.")
       sas3 = {'1. True becomes False and False becomes True.':'NOT Operator',
               '2. Operator, like the AND operator that, examines multiple conditions': 'OR Operator',
               '3. What is a Short-Circuit Evaluation?': 'It is a programming concept in which the compiler skips the execution or evaluation of some sub-expressions in a logical expression',
               '4. A variety of operators can be used to perform operations on values and variables.': 'Logical Operators',
               '5. In a programming concept, the compiler skips the execution or evaluation of some sub-expressions in a logical expression.': 'true',
               '6. When the value of the expression is not determined, the compiler stops evaluating the remaining sub-expressions.':'False',
               '7. A short circuit evaluation is a programming concept in which the compiler skips the execution or evaluation of some sub-expressions in a logical expression.': 'true',
               '8. A truth table is a common way to show logical relationships.': 'true',
               '9. not using parentheses to group the expression according to the order of precedence':'false',
               '10. If the program is now working properly, modify the code to iterate the result of the condition.': 'false'}
       correct = 0
       incorrect = 0
       for x in sas1:
           answer_key = sas1[x]
           print(x)
           answer = input('type your answer: ')
           if answer == answer_key:
               print('correct!')
               correct += 1
           else:
               print('incorrect!')
       print(' ')
       print(correct, "/", 10)
       print(' ')
       score = int(input('enter overall score: '))
       if score >= 15 and score <= 19:
           print('pass')
       elif score >= 20 and score <=29:
           print('great score')
       elif score == 30:
           print('perfect!')
       else:
           print('fail')
           break
   if attempts >= 5:
       print('No more attempts')
       exit()
