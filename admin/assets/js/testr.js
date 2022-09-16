
nums = [2,3,4];
 function find_max(nums) {
 let max_num = Number.NEGATIVE_INFINITY; // smaller than all other numbers
 for (let num of nums) {
 if (num > max_num) {
 	console.log(max_num + 'de' + num)
 // (Fill in the missing line here)
 }
 console.log(max_num + 'de' + num)
 }
 return max_num;
}