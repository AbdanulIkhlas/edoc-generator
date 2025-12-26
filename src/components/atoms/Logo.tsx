import { motion } from "framer-motion";

const Logo = () => {
  return (
    <motion.div 
      className="flex items-center gap-2"
      whileHover={{ scale: 1.02 }}
      whileTap={{ scale: 0.98 }}
    >
      <div className="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
        <span className="text-primary-foreground font-heading font-bold text-sm">A</span>
      </div>
      <span className="font-heading font-semibold text-lg text-foreground">alex.chen</span>
    </motion.div>
  );
};

export default Logo;
