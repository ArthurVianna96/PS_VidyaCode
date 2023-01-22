const getRegisterNumberInfo = async (registerNumber) => {

  const url = `https://publica.cnpj.ws/cnpj/${registerNumber}`;
  const response = await fetch(url);
  const data = await response.json();
  return data;
}

export default getRegisterNumberInfo;
