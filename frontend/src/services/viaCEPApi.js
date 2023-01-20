const getZipCodeInfo = async (zipCode) => {
  const url = `https://viacep.com.br/ws/${zipCode}/json/`;
  const response = await fetch(url);
  const data = await response.json();
  return data;
}

export default getZipCodeInfo;