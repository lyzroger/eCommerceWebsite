<?xml version="1.0"?>
<html xsl:version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/xhtml">
	<body>
		
		<h2 align="center">Product List</h2>
		<table border="0">
		  <tr style="color:#FFFFFF; background-color:#1A88D9">
			<th>Book ID</th>
			<th>Book Name</th>
			<th>Category</th>
			<th>Price</th>
			<th>Special Price</th>
			<th>Discount</th>
			<th>Start date</th>
			<th>End date</th>		
		  </tr>
		  
		  <xsl:for-each select="products/item">
			<xsl:choose>
		      <xsl:when test="(position() mod 2) = 1">
			  
			  <tr>
				<td><xsl:value-of select="id" /></td>
				<td><xsl:value-of select="name" /></td>
				<td><xsl:value-of select="category" /></td>
				<td><xsl:value-of select="price" /></td>
				<td style="color:red;"><xsl:value-of select="specialsale/price" /></td>
				<td style="color:red;"><xsl:value-of select="specialsale/discount" /></td>
				<td style="color:red;"><xsl:value-of select="specialsale/start" /></td>
				<td style="color:red;"><xsl:value-of select="specialsale/end" /></td>				
			  </tr>
			  
			  </xsl:when>
			  <xsl:otherwise>
			  <tr style="background-color:#ADC5FC">
				<td><xsl:value-of select="id" /></td>
				<td><xsl:value-of select="name" /></td>
				<td><xsl:value-of select="category" /></td>
				<td><xsl:value-of select="price" /></td>
				<td style="color:red;"><xsl:value-of select="specialsale/price" /></td>
				<td style="color:red;"><xsl:value-of select="specialsale/discount" /></td>
				<td style="color:red;"><xsl:value-of select="specialsale/start" /></td>
				<td style="color:red;"><xsl:value-of select="specialsale/end" /></td>				
			  </tr>			  
			  
			  </xsl:otherwise>
			</xsl:choose>
		  </xsl:for-each>
		</table>
	</body>
</html>
