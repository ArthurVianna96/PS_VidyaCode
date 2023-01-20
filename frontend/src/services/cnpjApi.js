const getRegisterNumberInfo = async (registerNumber) => {
  const token = 'b3f15f37f4ec77348c0a936c5b202d06d75834c1f6f0eb7021db77191ff33754';

  const url = `https://receitaws.com.br/v1/cnpj/${registerNumber}`;
  const response = await fetch(
    url, 
    { 
      method: 'GET', headers: { 
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
       }
    }
    );
  const data = await response.json();
  return data;
}

export default getRegisterNumberInfo;
