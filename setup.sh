[ "$(id -u)" -ne 2000 ] && echo "No shell permissions." && exit 1

echo ""
echo "**************************************"
echo "*   RiProG Open Source @ RiOpSo   *"
echo "**************************************"
echo "*      Muhammad Rizki @ RiProG      *"
echo "**************************************"
echo ""

sleep 2

echo ""
echo "Installing Non Root Thermods 1.1.1"
echo ""

sleep 2

if [[ ! $(cmd -l | grep thermalservice) ]]; then
echo "Not Supported"
exit
fi

sleep 2

thermal_status_override() {
cmd thermalservice override-status 0
}
thermal_status_override > /dev/null 2>&1 

sleep 2

echo ""
echo  "Non Root Thermods 1.1.1 installed"
echo ""
echo ""
